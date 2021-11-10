<?php

namespace App\Services\Company;

use App\Models\Company;
use App\Repositories\Company\CompanyRepository;

class CreateCompanyService
{
    public function __construct(
        private CompanyRepository $companyRepository
    ){
    }

    public function create(array $data): Company
    {
        return $this->companyRepository->create($data);
    }
}
