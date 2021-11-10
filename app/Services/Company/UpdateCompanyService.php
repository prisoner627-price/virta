<?php

namespace App\Services\Company;

use App\Models\Company;
use App\Repositories\Company\CompanyRepository;

class UpdateCompanyService
{
    public function __construct(
        private CompanyRepository $companyRepository
    ){
    }

    public function update(array $data, Company $company): Company
    {
        return $this->companyRepository->update($data, $company);
    }
}
