<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Storage;
use File;
use Session;

class CompaniesController extends Controller
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
     * @return Response
     */
    public function create()
    {
        return view('companies.form');
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
        if ($image = $request->file('logo')) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('/app/public');
            $image->move($destinationPath, $imagename);
            $data['logo'] = $imagename;
        }

        $company = Company::create($data);

        return redirect()->route('companies.index')->with('success', 'Company was successfully created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);

        return view('companies.form', compact('company'));

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
        $company = Company::findOrFail($id);
        $data = $request->except('_token', '_method', 'id');
        $image = $request->file('logo');

        if ($image) {
            if($company->logo) {
                $logo_path = public_path("/storage/".$company->logo);
                if(File::exists($logo_path)) {
                    File::delete($logo_path);
                }
            }
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('/app/public');
            $image->move($destinationPath, $imagename);
            $data['logo'] = $imagename;
        }
        $company = $company->update($data);

        return redirect()->route('companies.index')->with('success', 'Company was successfully updated.');
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
        $isDeleted = $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company was successfully deleted.');
    }
}
