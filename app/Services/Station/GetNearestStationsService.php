<?php

namespace App\Services\Station;

use App\Services\Station\DTOs\StationOutput;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Station\StationRepository;
use App\Services\Station\DTOs\NearestStationsOutput;

class GetNearestStationsService
{
    public function __construct(private StationRepository $stationRepository)
    {
    }

    // we can use introduce parameter object instead of this telescopic arguments LOL
    public function get(float $distance, float $lat, float $long, ?int $companyId): array
    {
        $result = $this->stationRepository->getNearestStations(
            $distance,
            $lat,
            $long,
            $companyId
        );

        return $this->transformToDTOs($result);
    }

    private function transformToDTOs(Collection $collection): array
    {
        $temp = [];
        foreach ($collection as $station) {
            $temp[$station->company_id][] = $station;
        }

        $result = [];
        foreach ($temp as $companyId => $stations) {
            $stationOutputs = [];
            foreach ($stations as $station) {
                $stationOutputs[] = new StationOutput(
                    $station->id,
                    $station->name,
                    $station->location->getLat(),
                    $station->location->getLng(),
                    $station->distance,
                    $station->address
                );
            }

            $result[] = new NearestStationsOutput(
                $companyId,
                $station->company->name,
                $stationOutputs
            );
        }

        return $result;
    }
}
