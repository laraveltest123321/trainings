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
    public function getAll()
    {
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
}
