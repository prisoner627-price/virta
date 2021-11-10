<?php

namespace App\Specifications;

use Illuminate\Database\Eloquent\Builder;

interface Specification
{
    public function toQuery(Builder $builder): Builder;

    public function and(Specification $other): Specification;
}
