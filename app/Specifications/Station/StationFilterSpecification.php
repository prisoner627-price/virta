<?php

namespace App\Specifications\Station;

use Illuminate\Database\Eloquent\Builder;
use App\Specifications\CompositeSpecification;

abstract class StationFilterSpecification extends CompositeSpecification
{
    abstract public function toQuery(Builder $builder): Builder;
}
