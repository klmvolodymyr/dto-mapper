<?php

namespace DataMapper\Strategy;

use DataMapper\Exception\InvalidArgumentException;

interface StrategyInterface
{
    /**
     * @throws InvalidArgumentException
     *
     * @param mixed $value
     * @param mixed $context
     *
     * @return mixed
     */
    public function hydrate($value, $context);
}