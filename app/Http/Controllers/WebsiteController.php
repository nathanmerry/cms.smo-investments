<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Company;

class Websitecontroller extends Controller
{
	protected $ipaddress = "167.99.194.56";

	/**
	 * display a listing of the resource.
	 *
	 * @return \illuminate\http\response
	 */
	public function index()
	{
		$query = Website::all();
		return view('websites.index', ['data' => $query]);
	}

	public function indexApi()
	{
		$query = Website::all();
		return $query;
	}
	/**
	 * store a newly created resource in storage.
	 *
	 * @param  \illuminate\http\request  $request
	 * @return \illuminate\http\response
	 */
	public function store(request $request)
	{
		$request->validate([
			'website_name' => 'required|unique:website,website_name',
			'website_slug' => 'required|unique:website,website_slug',
			'website_address' => 'required|unique:website,website_address',
			'ftp_username' => 'required',
			'ftp_password' => 'required',
		]);

		Website::create([
			'website_name' => $request->website_name,
			'website_slug' => $request->website_slug,
			'website_address' => $request->website_address,
			'ftp_username' => $request->ftp_username,
			'ftp_password' => $request->ftp_password
		]);

		return redirect('/websites/' . $request->website_slug . '/edit');
	}

	public function create(request $request)
	{
		$query = Website::all();
		return view('websites.create', ['websites' => $query]);
	}

	/**
	 * display the specified resource.
	 *
	 * @param  int  $id
	 * @return \illuminate\http\response
	 */
	public function show($slug)
	{
		$query = DB::table('website');

		$websites = Website::all();

		$company = Company::all();

		$website = $query->where('website_slug', '=', $slug)->get()->first();

		if (!$website) {
			abort(404);
		}

		$form = [
			'website' => [
				'website_name' => $website->{'website_name'},
				'website_address' => $website->{'website_address'},
				'website_short_address' => $website->{'website_short_address'},
			],
			'color' => [
				"brand_colour" => $website->{'brand_colour'},
				"header_colour" => $website->{'header_colour'},
				"header_font_colour" => $website->{'header_font_colour'},
				"header_font_colour_hover" => $website->{'header_font_colour_hover'},
				"footer_background_colour" => $website->{'footer_background_colour'},
				"footer_font_colour" => $website->{'footer_font_colour'},
				"second_colour" => $website->{'second_colour'},
				"homepage_block_colour" => $website->{'homepage_block_colour'},
				"warning_block" => $website->{'warning_block'},
				"homepage_heading_colour" => $website->{'homepage_heading_colour'},
				"homepage_span_colour" => $website->{'homepage_span_colour'},
				"homepage_reasons_colour" => $website->{'homepage_reasons_colour'},
				"homepage_block_border" => $website->{'homepage_block_border'},
				"button_colour" => $website->{'button_colour'},
				"button_colour_border" => $website->{'button_colour_border'},
				"button_colour_hover" => $website->{'button_colour_hover'},
				"slider_colour" => $website->{'slider_colour'},
				"loan_information_colour" => $website->{'loan_information_colour'}
			],
			'ctas' => [
				"home_cta_one" => $website->{'home_cta_one'},
				"home_cta_two" => $website->{'home_cta_two'},
				"home_cta_three" => $website->{'home_cta_three'}
			],
			'images' => [
				"home_image_one" => $website->{'home_image_one'},
				"home_image_two" => $website->{'home_image_one'},
				"home_image_three" => $website->{'home_image_three'},
			],
			'text' => [
				"h1" => $website->{'h1'},
				"h2c" => $website->{'h2c'},
				"h3c" => $website->{'h3c'},
				"P" => $website->{'p'}
			],
			'ID' => $website->{'id'},
			'logo_filename' => $website->logo_filename,
			'logo_url' => $website->logo_url,
			'company' => [
				'all' => $company,
				'selected' => $website->company,
			],
			'ftp' => [
				'ftp_username' => $website->ftp_username,
				'ftp_password' => $website->ftp_password,
			],
		];

		return view('websites.show', ['data' => [
			'websites' => $websites,
			'website' => $website->website_name,
			'form' => $form,
		]]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \illuminate\http\request  $request
	 * @param  int  $id
	 * @return \illuminate\http\response
	 */
	public function update(request $request)
	{
		$query = Website::where('id', $request->get('ID'));
		$data = request()->except('_token');

		$logo = $request->file('logo_filename');

		if ($logo) {
			Storage::disk('public')->put(
				$logo->getFilename() . '.' . $logo->getClientOriginalExtension(),
				File::get($logo)
			);

			$data['logo_filename'] = $logo->getClientOriginalName();
			$data['logo_url'] = url('uploads/' . $logo->getFilename() . '.' . $logo->getClientOriginalExtension());
		}

		$query->update($data);

		Session::flash('message', $data['website_name'] . ' Updated successfully !');

		return redirect('websites/' . $query->get()->first()->website_slug . '/edit');
	}

	/**
	 * remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \illuminate\http\response
	 */
	public function destroy()
	{
		DB::table('website')->where('id', request()->id)->delete();
		return redirect('/websites');
	}

	public function ftp()
	{
		$collection = Website::all();
		$data = $collection->sortBy('website_name');
		
		return view('websites.ftp', ['data' => $data]);
	}
}
