<?php

namespace App\Services\Station\DTOs;

class NearestStationsOutput
{
    public function __construct(
        public int $companyId,
        public string $companyName,
        private array $stationOutputs
    ) {
    }

    // God bless symfony normalizer component :-)
    public function toArray(): array
    {
        $stations = [];
        foreach ($this->stationOutputs as $stationOutput) {
            $stations[] = $stationOutput->toArray();
        }

        return [
            'companyId' => $this->companyId,
            'companyName' => $this->companyName,
            'stations' => $stations,
        ];
    }
}
