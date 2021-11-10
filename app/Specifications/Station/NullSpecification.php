<?php

namespace App\Specifications\Station;

use Illuminate\Database\Eloquent\Builder;

class NullSpecification extends StationFilterSpecification
{
    public function toQuery(Builder $builder): Builder
    {
        return $builder;
    }
}
