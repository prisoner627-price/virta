<?php

namespace App\Specifications\Station;

use Illuminate\Database\Eloquent\Builder;

class NameSpecification extends StationFilterSpecification
{
    public function __construct(private string $name)
    {
    }

    public function toQuery(Builder $builder): Builder
    {
        return $builder->where('stations.name', 'like', "%{$this->name}%");
    }
}

