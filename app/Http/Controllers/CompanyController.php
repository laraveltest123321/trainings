<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyData;
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
        $companies = Company::all();

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
    public function store(CompanyData $request)
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

        return back()->with('success','Company was successfully created');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $logo_path = public_path("/storage/".$company->logo);  // Value is not URL but directory file path
        if(File::exists($logo_path)) {
            File::delete($logo_path);
        }
        $delete = $company->delete();
        if ($delete) {
            Session::flash('success', 'Company was successfully deleted.');
        } else {
            Session::flash('failed', 'Something went wrong');
        }


        return back();
    }
}
