<?php
namespace App\Services;

use App\Models\Employee;

class EmployeeService
{
    /**
     * Get all employees.
     *
     * @return App\Models\Employee
     */
    public function getAll()
    {
        return Employee::all();
    }

    /**
     * Find an employee by id.
     *
     * @param int $id.
     *
     * @return App\Models\Employee
     */
    public function getById($id)
    {
        return Employee::where('id', $id)->first();
    }
}
