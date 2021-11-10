<?php

namespace App\Specifications;

abstract class CompositeSpecification implements Specification
{
    public function and(Specification $other): Specification
    {
        return new AndSpecification($this, $other);
    }
}
