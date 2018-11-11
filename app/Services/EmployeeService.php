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
    public function getAll($paginate = true, $paginationCount = 10)
    {
        if($paginate) {
            return Employee::paginate($paginationCount);
        }
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

    /**
     * Create new employee.
     *
     * @param array $data.
     *
     * @return App\Models\Employee
     */
    public function create($data)
    {
        return Employee::create($data);
    }
}
