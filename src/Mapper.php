<?php

namespace DataMapper;

use DataMapper\Hydrator\HydratorFactoryInterface;
use DataMapper\Type\TypeDict;

class Mapper implements MapperInterface
{
    private $hydratorFactor;

    public function __construct(HydratorFactoryInterface  $hydratorFactor)
    {
        $this->hydratorFactor = $hydratorFactor;
    }

    /**
     * {@inheritDoc}
     */
    public function convert($source, $destination)
    {
        if (null === $source || !(\is_object($source)) || \is_array($source)) {
            return $source;
        }

        $dto = $this
            ->hydratorFactor
            ->createHydrator($source, $destination)
            ->hydrate($source, $destination);

        return $dto;
    }

    /**
     * {@inheritDoc}
     */
    public function convertCollection(iterable $sources, string $destination): iterable
    {
        foreach ($sources as $key => $source) {
            yield $this->convert($source, $destination);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function extract(object $source): array
    {
        return $this
            ->hydratorFactor
            ->createHydrator($source, TypeDict::ARRAY_TYPE)
            ->extract($source);
    }
}