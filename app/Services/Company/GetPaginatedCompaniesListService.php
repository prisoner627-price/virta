<?php

namespace App\Services\Company;

use App\Specifications\Pagination;
use App\Specifications\Specification;
use App\Repositories\Company\CompanyRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetPaginatedCompaniesListService
{
    public function __construct(
        private CompanyRepository $companyRepository
    ){
    }

    public function get(Specification $specification, Pagination $pagination): LengthAwarePaginator
    {
        return $this->companyRepository
            ->paginateMatchingSpecification($specification, $pagination);
    }
}
