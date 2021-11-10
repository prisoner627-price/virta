<?php

namespace App\Specifications\Station;

use Illuminate\Database\Eloquent\Builder;

class CompanySpecification extends StationFilterSpecification
{
    public function __construct(private int $companyId)
    {
    }

    public function toQuery(Builder $builder): Builder
    {
        return $builder->where('stations.company_id', $this->companyId);
    }
}

