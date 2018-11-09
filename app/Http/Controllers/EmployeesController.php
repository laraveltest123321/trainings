<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\Company;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('company')->paginate(10);

        return view('employees.index', compact('employees'));
    }

       /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $companies = Company::all();

        return view('employees.form', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $data = $request->only(['company_id', 'first_name', 'last_name', 'email', 'phone']);
        Employee::create($data);

        return redirect()->route('employees.index')->with('success', 'Employee was successfully created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::all();
        $employees = Employee::where('id', '!=', $id)->paginate(10);
        $employee = Employee::findOrFail($id);

        return view('employees.form', compact('companies', 'employees', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $data = $request->only(['company_id', 'first_name', 'last_name', 'email', 'phone']);
        Employee::where('id', $id)->update($data);

        return redirect()->route('employees.index')->with('success', 'Employee was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee was successfully deleted.');
    }
}
