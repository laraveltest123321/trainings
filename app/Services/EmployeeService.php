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
    public function store($data)
    {
        return Employee::create($data);
    }


    /**
     * Update existing employee.
     *
     * @param int $id
     * @param array $data.
     *
     * @return boolean
     */
    public function update($id, $data)
    {
        $employee = $this->getById($id);
        return $employee->update($data);
    }

    /**
     * Destroy existing employee.
     *
     * @param int $id
     *
     * @return boolean
     */
    public function destroy($id)
    {
        $employee = $this->getById($id);
        return $employee->delete();
    }
}
