<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{
    protected $ipAddress = "167.99.194.56";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Website::all();

        $data = $query->map(function ($item) {
            return [
                'name' => $item->{'Website_Name'},
                'slug' => str_replace(' ', '-', strtolower($item->{'Website_Name'}))
            ];
        });

        return view('websites.index', ['data' => $data]);
    }

    public function checkFtpLogin(Request $request)
    {
        $conn_id = ftp_connect($this->ipAddress);
        if (@ftp_login($conn_id, $request->ftpUser, $request->ftpPassword)) {
            return [
                'success' => true,
                'header' => 'FTP connection secured',
                'message' => 'Please press continue if you wish to upload the files to <span class="font-bold">' . $request->ftpUser . '</span>',
            ];
        } else {
            return [
                'success' => false,
                'header' => 'FTP connection not secured',
                'message' => 'Please try again with different login details, or check your FTP account.',
            ];
        }
        ftp_close($conn_id);
    }

    public function storeNewSiteFiles(Request $request)
    {
        $ftp = new \FtpClient\FtpClient();
        $ftp->connect($this->ipAddress);
        $ftp->login($request->ftpUser, $request->ftpPassword);

        $sourceFile = __DIR__ . '/../../../newSiteFiles/' . $request->file;

        if ($request->file === '.' || $request->file === '..') {
            return [
                'files' => false
            ];
        }

        if (is_file($sourceFile)) {
            $ftp->chdir('/public_html');
            $ftp->put($request->file, $sourceFile);
        } else {
            $ftp->mkdir('/public_html' . '/' . $request->file);
            $ftp->putAll($sourceFile, '/public_html/' . $request->file);
        }

        $uploaded = array_column($ftp->scanDir('/public_html'), 'name');

        return ['files' => $uploaded];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:websites,Website_Slug',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'header' => 'Upload Failed',
                'message' => 'This website already exists! Please choose another one and ensure the slug is unique.',
            ];
        }

        $saved = Website::create([
            'Website_Name' => $request->name,
            'Website_Slug' => $request->slug
        ]);

        if ($saved) {
            return [
                'success' => true,
                'message' => 'Website Saved to CMS'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Could not save website to CMS!',
            ];
        }
    }

    public function create(Request $request)
    {
        $query = Website::all();

        $websites = $query->map(function ($item) {
            return [
                'name' => $item->{'Website_Name'},
                'slug' => $item->{'Website_Slug'}
            ];
        });

        $ftpFiles = scandir(__DIR__ . '/../../../newSiteFiles');

        return view('websites.create', ['websites' => $websites, 'ftpFiles' => $ftpFiles]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $query = DB::table('Websites');

        $websites = $query->get()->map(function ($item) {
            return [
                'name' => $item->{'Website_Name'},
                'slug' => $item->Website_Slug
            ];
        });

        $website = $query->where('Website_Slug', '=', $slug)->get()->first();

        if (!$website) {
            abort(404);
        }

        $form = [
            'website' => [
                'Website_Name' => $website->{'Website_Name'},
                'Website_Address' => $website->{'Website_Address'},
                'Website_Short_Address' => $website->{'Website_Short_Address'},
            ],
            'color' => [
                "Brand_Colour" => $website->{'Brand_Colour'},
                "Header_Colour" => $website->{'Header_Colour'},
                "Header_Font_Colour" => $website->{'Header_Font_Colour'},
                "Header_Font_Colour_Hover" => $website->{'Header_Font_Colour_Hover'},
                "Footer_Background_Colour" => $website->{'Footer_Background_Colour'},
                "Footer_Font_Colour" => $website->{'Footer_Font_Colour'},
                "Second_Colour" => $website->{'Second_Colour'},
                "Homepage_Block_Colour" => $website->{'Homepage_Block_Colour'},
                "Warning_Block" => $website->{'Warning_Block'},
                "Homepage_Heading_Colour" => $website->{'Homepage_Heading_Colour'},
                "Homepage_Span_Colour" => $website->{'Homepage_Span_Colour'},
                "Homepage_Reasons_Colour" => $website->{'Homepage_Reasons_Colour'},
                "Homepage_Block_Border" => $website->{'Homepage_Block_Border'},
                "Button_Colour" => $website->{'Button_Colour'},
                "Button_Colour_Border" => $website->{'Button_Colour_Border'},
                "Button_Colour_Hover" => $website->{'Button_Colour_Hover'},
                "Slider_Colour" => $website->{'Slider_Colour'},
                "Loan_Information_Colour" => $website->{'Loan_Information_Colour'}
            ],
            'ctas' => [
                "Home_CTA_One" => $website->{'Home_CTA_One'},
                "Home_CTA_Two" => $website->{'Home_CTA_Two'},
                "Home_CTA_Three" => $website->{'Home_CTA_Three'}
            ],
            'images' => [
                "Home_Image_One" => $website->{'Home_Image_One'},
                "Home_Image_Two" => $website->{'Home_Image_One'},
                "Home_Image_Three" => $website->{'Home_Image_Three'},
            ],
            'text' => [
                "H1" => $website->{'H1'},
                "h2c" => $website->{'h2c'},
                "h3c" => $website->{'h3c'},
                "P" => $website->{'P'}
            ],
            'ID' => $website->{'ID'}
        ];

        return view('websites.show', ['data' => [
            'websites' => $websites,
            'website' => $website->Website_Name,
            'form' => $form,
        ]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $query = DB::table('Websites')->where('ID', $request->get('ID'));

        $data = request()->except('_token');

        foreach ($data as $key => $item) {
            if (is_null($item)) {
                $data[$key] = '&nbsp';
            }
        }

        $query->update($data);

        Session::flash('message', $data['Website_Name'] . ' Updated Successfully !');

        return redirect('websites/' . $query->get()->first()->Website_Slug . '/edit');
    }

    public function slug(Request $request)
    {
        $getQuery = DB::table('Websites')->get();

        foreach ($getQuery as $key => $item) {
            $slug = str_replace(' ', '-', strtolower($item->{'Website_Name'}));

            $query = DB::table('Websites')->where('Website_Name', $item->{'Website_Name'});

            $query->update(['Website_Slug' => $slug]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
