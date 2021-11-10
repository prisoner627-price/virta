<?php

namespace App\Repositories\Company;

use App\Models\Company;
use App\Specifications\Pagination;
use App\Repositories\BaseRepository;
use App\Specifications\Specification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CompanyRepository extends BaseRepository
{
    protected array $fillable = ['name', 'parent_id'];

    protected function model(): string
    {
        return Company::class;
    }

    public function paginateMatchingSpecification(
        Specification $specification,
        Pagination $pagination
    ): LengthAwarePaginator {
        return $specification->toQuery(Company::query())
            ->with(['parent'])
            ->orderBy('id', 'desc')
            ->paginate($pagination->getPerPage(), ['*'], 'page', $pagination->getPage());
    }
}
