<?php

namespace App\Services\Station;

use App\Models\Station;
use App\Repositories\Station\StationRepository;

class CreateStationService
{
    public function __construct(
        private StationRepository $stationRepository
    ){
    }

    public function create(array $data): Station
    {
        return $this->stationRepository->create($data);
    }
}

