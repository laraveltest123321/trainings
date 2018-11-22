<?php
namespace App\Services;

use App\Models\Company;
use File;

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
     * @param nullable file @img.
     *
     * @return App\Models\Company
     */
    public function store($data, $img = null)
    {
        if ($img) {
            $imagename = time().'.'.$img->getClientOriginalExtension();
            $destinationPath = storage_path('/app/public');
            $img->move($destinationPath, $imagename);
            $data['logo'] = $imagename;
        }
        return Company::create($data);
    }


    /**
     * Update existing company.
     *
     * @param int $id
     * @param array $data.
     * @param nullable file @img.
     *
     * @return boolean
     */
    public function update($id, $data, $img = null)
    {
        $company = $this->getById($id);
        if ($img) {
            if($company->logo) {
                $logoPath = storage_path("/storage/".$company->logo);
                if(File::exists($logoPath)) {
                    File::delete($logoPath);
                }
            }
            $imagename = time().'.'.$img->getClientOriginalExtension();
            $destinationPath = storage_path('/app/public');
            $img->move($destinationPath, $imagename);
            $data['logo'] = $imagename;
        }
        if ($company) {
            return $company->update($data);
        }
        return false;
    }

    /**
     * Destroy existing company.
     *
     * @param int $id
     *
     * @return boolean
     */
    public function destroy($id)
    {
        $company = $this->getById($id);
        $logoPath = storage_path("/storage/".$company->logo);
        if(File::exists($logoPath)) {
            File::delete($logoPath);
        }
        if ($company) {
            return $company->delete();
        }
        return false;
    }
}
