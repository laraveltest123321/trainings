<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Storage;
use File;
use Session;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $data = $request->all();
        $image = $request->file('logo');
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = storage_path('/app/public');
        $image->move($destinationPath, $input['imagename']);
        $data['logo'] = $input['imagename'];
        $company = Company::create($data);
        if ($company) {
            Session::flash('success', 'Company was successfully created.');
        } else {
            Session::flash('failed', 'Something went wrong');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::where('id', '!=', $id)->paginate(10);
        $company = Company::findOrFail($id);

        return view('companies.index', compact('companies', 'company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $company_old = Company::findOrFail($id);
        $data = $request->except('_token', '_method', 'id');
        $image = $request->file('logo');

        if ($image) {
            if($company_old->logo) {
                $logo_path = public_path("/storage/".$company_old->logo);
                if(File::exists($logo_path)) {
                    File::delete($logo_path);
                }
            }
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('/app/public');
            $image->move($destinationPath, $input['imagename']);
            $data['logo'] = $input['imagename'];
        }
        $company = Company::where('id', $id)->update($data);
        if ($company) {
            Session::flash('success', 'Company was successfully updated.');
        } else {
            Session::flash('failed', 'Something went wrong');
        }

        return redirect()->action('CompanyController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $logo_path = public_path("/storage/".$company->logo);
        if(File::exists($logo_path)) {
            File::delete($logo_path);
        }
        $delete = $company->delete();
        if ($delete) {
            Session::flash('success', 'Company was successfully deleted.');
        } else {
            Session::flash('failed', 'Something went wrong');
        }

        return redirect()->action('CompanyController@index');
    }
}
