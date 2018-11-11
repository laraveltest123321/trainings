<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Services\EmployeeService;
use App\Services\CompanyService;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EmployeeService $employeeService)
    {
        $employees = $employeeService->getAll(true, 10);
        $employees->load('company');
        return view('employees.index', compact('employees'));
    }

       /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(CompanyService $companyService)
    {
        $companies = $companyService->getAll(false);
        return view('employees.form', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request, EmployeeService $employeeService)
    {
        $data = $request->only(['company_id', 'first_name', 'last_name', 'email', 'phone']);
        $employeeService->create($data);
        return redirect()->route('employees.index')->with('success', 'Employee was successfully created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeService $employeeService, CompanyService $companyService, $id)
    {
        $companies = $companyService->getAll(false);
        $employee = $employeeService->getById($id);
        return view('employees.form', compact('companies', 'employees', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, EmployeeService $employeeService, $id)
    {
        $data = $request->only(['company_id', 'first_name', 'last_name', 'email', 'phone']);
        $employeeService->getById($id)->update($data);
        return redirect()->route('employees.index')->with('success', 'Employee was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeService $employeeService, $id)
    {
        $employeeService->getById($id)->delete();
        return redirect()->route('employees.index')->with('success', 'Employee was successfully deleted.');
    }
}
