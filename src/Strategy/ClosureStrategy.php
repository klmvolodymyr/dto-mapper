<?php

namespace DataMapper\Strategy;

use DataMapper\Exception\InvalidArgumentException;

class ClosureStrategy implements StrategyInterface
{
    /**
     * @var callable
     */
    private $hydrateFunc;

    /**
     * ClosureStrategy constructor.
     *
     * @param callable $hydrateFunc
     *
     * @throws InvalidArgumentException
     */
    public function __construct(callable $hydrateFunc)
    {
        $this->hydrateFunc = $hydrateFunc;
    }

    /**
     * {@inheritDoc}
     */
    public function hydrate($value, $context)
    {
        $func = $this->hydrateFunc;

        return $func($value, $context);
    }
}