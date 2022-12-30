<?php

namespace DataMapper\Strategy;

class ChainStrategy implements StrategyInterface
{
    /**
     * Chain of strategies for extraction
     *
     * @var StrategyInterface[]
     */
    private $strategies;

    /**
     * ChainStrategy constructor.
     *
     * @param array $strategies
     */
    public function __construct(array $strategies)
    {
        $this->strategies = \array_map(
            function (StrategyInterface $strategy) {
                // this callback is here only to ensure type-safety
                return $strategy;
            },
            $strategies
        );
    }

    /**
     * {@inheritDoc}
     */
    public function hydrate($value, $context)
    {
        foreach ($this->strategies as $strategy) {
            $value = $strategy->hydrate($value, $context);
        }

        return $value;
    }
}