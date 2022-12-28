<?php

namespace DataMapper\Aggregation\Specification;

class IncrementValueSpecification
{
    public static function create(): \Closure
    {
        return function (int $value, ?int $incr = 1): int {
            return $value + $incr;
        };
    }
}