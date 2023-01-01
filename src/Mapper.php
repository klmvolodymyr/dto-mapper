<?php

namespace DataMapper;

use DataMapper\Hydrator\HydratorFactoryInterface;
use DataMapper\Type\TypeDict;

class Mapper implements MapperInterface
{
    private $hydratorFactory;

    public function __construct(HydratorFactoryInterface  $hydratorFactory)
    {
        $this->hydratorFactory = $hydratorFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function convert($source, $destination)
    {
        if (null === $source || !(\is_object($source) || \is_array($source))) {
            return $source;
        }

        $dto = $this
            ->hydratorFactory
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
            ->hydratorFactory
            ->createHydrator($source, TypeDict::ARRAY_TYPE)
            ->extract($source);
    }
}