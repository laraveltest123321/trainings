<?php
namespace App\Services;

use App\Models\Company;

class CompanyService
{
    /**
     * Get all companies.
     *
     * @return App\Models\Company
     */
    public function getAll($paginate = true, $paginationCount = 10)
    {
        if($paginate) {
            return Company::paginate($paginationCount);
        }
        return Company::all();
    }

    /**
     * Find an company by id.
     *
     * @param int $id.
     *
     * @return App\Models\Company
     */
    public function getById($id)
    {
        return Company::where('id', $id)->first();
    }

    /**
     * Create new company.
     *
     * @param array $data.
     *
     * @return App\Models\Company
     */
    public function create($data)
    {
        return Company::create($data);
    }
}
