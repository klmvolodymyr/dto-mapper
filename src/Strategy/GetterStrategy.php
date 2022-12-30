<?php

namespace DataMapper\Strategy;

use DataMapper\Exception\InvalidArgumentException;

class GetterStrategy implements StrategyInterface
{
    /**
     * @var string
     */
    private $methodToCall;

    /**
     * GetterStrategy constructor.
     *
     * @param string $methodToCall
     */
    public function __construct(string $methodToCall)
    {
        $this->methodToCall = $methodToCall;
    }

    /**
     * {@inheritDoc}
     */
    public function hydrate($value, $context)
    {
        [$sourceContext] = $context;

        if (!\is_object($sourceContext)) {
            throw new InvalidArgumentException('$sourceContext - argument must be object');
        }

        if (!\is_callable([$sourceContext, $this->methodToCall])) {
            throw new InvalidArgumentException(
                \get_class($sourceContext) .
                "- getter method: {$this->methodToCall} must be callable"
            );
        }

        return $sourceContext->{$this->methodToCall}();
    }
}