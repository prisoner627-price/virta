<?php

namespace App\Specifications;

use Illuminate\Database\Eloquent\Builder;

class AndSpecification extends CompositeSpecification
{
    public function __construct(
        private Specification $left,
        private Specification $right
    ) {
    }

    public function toQuery(Builder $builder): Builder
    {
        return $this->right->toQuery(
            $this->left->toQuery($builder)
        );
    }
}
