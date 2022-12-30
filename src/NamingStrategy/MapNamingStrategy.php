<?php

namespace DataMapper\NamingStrategy;

use DataMapper\Exception\InvalidArgumentException;

class MapNamingStrategy implements NamingStrategyInterface
{
    protected $mapping = [];
    protected $reverse = [];

    public function __construct(array $mapping, ?array $reverse)
    {
        $this->mapping = $mapping;
        $this->reverse = $reverse ?: $this->flipMapping($mapping);
    }

    /**
     * {@inheritDoc}
     */
    public function hydrate(string $name, $context = null): string
    {
        if(\array_key_exists($name, $this->mapping)) {
            return $this->mapping[$name];
        }

        return $name;
    }

    /**
     * {@inheritDoc}
     */
    public function extract(string $name): string
    {
        if (\array_key_exists($name, $this->reverse)) {
            return $this->reverse[$name];
        }

        return $name;
    }

    protected function flipMapping(array $array): array
    {
        \array_walk($array, function ($value) {
            if (!\is_string($value) && !\is_int($value)) {
                throw new InvalidArgumentException('Mapping array can\'t be flipped because of invalid value');
            }
        });

        return \array_flip($array);
    }
}