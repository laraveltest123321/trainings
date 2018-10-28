<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\Company;
use Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('company')->paginate(10);
        $companies = Company::all();

        return view('employees.index', compact('employees', 'companies'));
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
    public function store(EmployeeRequest $request)
    {
        $data = $request->all();
        $employee = Employee::create($data);
        if ($employee) {
            Session::flash('success', 'Employee was successfully created.');
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
        $companies = Company::all();
        $employees = Employee::where('id', '!=', $id)->paginate(10);
        $employee = Employee::findOrFail($id);

        return view('employees.index', compact('companies', 'employees', 'employee'));
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
        $data = $request->except('_token', '_method', 'id');
        $employee = Employee::where('id', $id)->update($data);
        if ($employee) {
            Session::flash('success', 'Employee was successfully updated.');
        } else {
            Session::flash('failed', 'Something went wrong');
        }

        return redirect()->action('EmployeeController@index');
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
        $delete = $employee->delete();
        if ($delete) {
            Session::flash('success', 'Employee was successfully deleted.');
        } else {
            Session::flash('failed', 'Something went wrong');
        }

        return redirect()->action('EmployeeController@index');
    }
}
