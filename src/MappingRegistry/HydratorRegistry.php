<?php

namespace DataMapper\MappingRegistry;

use DataMapper\Hydrator\AbstractHydrator;
use DataMapper\MappingRegistry\Exception\DuplicateTypeException;
use DataMapper\MappingRegistry\Exception\UnknownHydratorTypeException;
use DataMapper\Util\RegistryContainer;

final class HydratorRegistry extends RegistryContainer implements HydratorRegistryInterface
{
    /**
     * {@inheritDoc}
     */
    public function getHydratorByType(string $type): AbstractHydrator
    {
        if (!$this->hasRegisterHydrator($type)) {
            throw new UnknownHydratorTypeException($type);
        }

        return clone $this->offsetGet($type);
    }


    /**
     * {@inheritDoc}
     */
    public function registerHydrator(AbstractHydrator $hydrator, string $type): void
    {
        if ($this->hasRegisterHydrator($type)) {
            throw new DuplicateTypeException($type);
        }

        $this->offsetSet($type, $hydrator);
    }

    /**
     * {@inheritDoc}
     */
    public function hasRegisterHydrator(string $type): bool
    {
        return $this->offsetExists($type);
    }
}