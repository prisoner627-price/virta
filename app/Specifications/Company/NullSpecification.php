<?php

namespace App\Specifications\Company;

use Illuminate\Database\Eloquent\Builder;

class NullSpecification extends CompanyFilterSpecification
{
    public function toQuery(Builder $builder): Builder
    {
        return $builder;
    }
}
