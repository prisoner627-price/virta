<?php

namespace App\Services\Station;

use App\Models\Station;
use App\Repositories\Station\StationRepository;

class DeleteStationService
{
    public function __construct(
        private StationRepository $stationRepository
    ){
    }

    public function delete(Station $station): bool
    {
        return $this->stationRepository->delete($station);
    }
}
