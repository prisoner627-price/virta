<?php

namespace App\Specifications\Company;

use Illuminate\Database\Eloquent\Builder;

class NameSpecification extends CompanyFilterSpecification
{
    public function __construct(private string $name)
    {
    }

    public function toQuery(Builder $builder): Builder
    {
        return $builder->where('companies.name', 'like', "%{$this->name}%");
    }
}

