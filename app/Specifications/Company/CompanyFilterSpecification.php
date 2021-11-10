<?php

namespace App\Specifications\Company;

use Illuminate\Database\Eloquent\Builder;
use App\Specifications\CompositeSpecification;

abstract class CompanyFilterSpecification extends CompositeSpecification
{
    abstract public function toQuery(Builder $builder): Builder;
}
