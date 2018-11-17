<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Services\CompanyService;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CompanyService $companyService)
    {
        $companies = $companyService->getAll(true, 10);
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
    public function store(CompanyRequest $request, CompanyService $companyService)
    {
        $data = $request->only(['name', 'email', 'website']);
        $companyService->store($data, $request->file('logo'));
        return redirect()->route('companies.index')->with('success', 'Company was successfully created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyService $companyService, $id)
    {
        $company = $companyService->getById($id);
        return view('companies.form', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, CompanyService $companyService, $id)
    {
        $data = $request->only(['name', 'email', 'website']);
        $companyService->update($id, $data, $request->file('logo'));
        return redirect()->route('companies.index')->with('success', 'Company was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyService $companyService, $id)
    {
        $companyService->destroy($id);
        return redirect()->route('companies.index')->with('success', 'Company was successfully deleted.');
    }
}
