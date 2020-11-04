<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Company::all();

        $data = $query->map(function ($company) {
            return [
                'name' => $company->company_name,
                'id' => $company->id,
            ];
        });

        return view('company.index', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = new Company();

        $companies = $query::all()->map(function ($company) {
            return [
                'name' => $company->company_name,
                'id' => $company->id,
            ];
        });

        $company = $query::where('id', $id)->get()->first();

        $form = [
            'id' => $company->id,
            'amount' => [
                'min_la' => $company->min_la,
                'max_la' => $company->max_la,
                'min_lt' => $company->min_lt,
                'max_lt' => $company->max_lt
            ],
            'company' => [
                "company_name" => $company->company_name,
                "company_number" => $company->company_number,
                "company_address" => $company->company_address
            ],
            'home' => [
                "home_step_one" => $company->home_step_one,
                "home_step_two" => $company->home_step_two,
                "home_step_three" => $company->home_step_three
            ],
            'misc' => [
                "interestrates" => $company->interestrates,
                "legal" => $company->legal,
                "apr" => $company->apr,
                "rep_example" => $company->rep_example,
                "credit_report" => $company->credit_report,
                "increments" => $company->increments,
                "terms" => $company->terms,
                "Footer_Text" => $company->Footer_Text,
                "Warning" => $company->Warning,
                "fca_number" => $company->fca_number,
                "ico_number" => $company->ico_number,
                "homepage_legal_block" => $company->homepage_legal_block,
                "warning_block_text" => $company->warning_block_text,
                "terms_url" => $company->terms_url,
                "home_ctas" => $company->home_ctas
            ]
        ];

        return view('company.show', [
            'form' => $form, 'companies' => $companies, 'company' => $company->company_name
        ]);
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
        $query = DB::table('company')->where('id', $request->get('id'));

        $data = request()->except('_token');

        $query->update($data);

        Session::flash('message', $data['company_name'] . ' Updated Successfully !');

        return redirect('companies/' . $request->id);
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
