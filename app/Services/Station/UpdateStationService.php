<?php

namespace App\Services\Station;

use App\Models\Station;
use App\Repositories\Station\StationRepository;

class UpdateStationService
{
    public function __construct(
        private StationRepository $stationRepository
    ){
    }

    public function update(array $data, Station $station): Station
    {
        return $this->stationRepository->update($data, $station);
    }
}
