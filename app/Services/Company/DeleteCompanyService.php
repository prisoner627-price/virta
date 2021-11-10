<?php

namespace App\Services\Company;

use App\Models\Company;
use App\Repositories\Company\CompanyRepository;

class DeleteCompanyService
{
    public function __construct(
        private CompanyRepository $companyRepository
    ){
    }

    public function delete(Company $company): bool
    {
        return $this->companyRepository->delete($company);
    }
}
