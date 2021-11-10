<?php

namespace App\Services\Station\DTOs;

class StationOutput
{
    public function __construct(
        public int $id,
        public string $name,
        public float $lat,
        public float $long,
        public float $distance,
        public string $address,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lat' => $this->lat,
            'long' => $this->long,
            'distance' => $this->distance,
            'address' => $this->address,
        ];
    }
}
