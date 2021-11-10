<?php

namespace App\Services\Station;

use App\Repositories\Station\StationRepository;
use App\Specifications\Pagination;
use App\Specifications\Specification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetPaginatedStationsListService
{
    public function __construct(
        private StationRepository $stationRepository
    ){
    }

    public function get(Specification $specification, Pagination $pagination): LengthAwarePaginator
    {
        return $this->stationRepository
            ->paginateMatchingSpecification($specification, $pagination);
    }
}
