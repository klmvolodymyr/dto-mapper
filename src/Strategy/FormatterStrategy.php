<?php

namespace DataMapper\Strategy;

use DataMapper\Exception\InvalidArgumentException;

class FormatterStrategy implements StrategyInterface
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
        [$sourceContext, $propertyName] = $context;

        if (!\is_object($sourceContext)) {
            throw new InvalidArgumentException('$context - argument must be object');
        }

        if (!\is_callable([$sourceContext, $this->methodToCall])) {
            throw new InvalidArgumentException(
                \get_class($sourceContext) .
                '- getter method: {$this->methodToCall} must be callable'
            );
        }

        return $sourceContext->{$this->methodToCall}($value);
    }
}