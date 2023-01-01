<?php

namespace DataMapper\Util;

use DataMapper\MappingRegistry\Exception\DuplicateTypeException;
use DataMapper\MappingRegistry\Exception\MappingRegistryException;

abstract class RegistryContainer implements \ArrayAccess
{
    protected $container = [];

    /**
     * {@inheritDoc}
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * @throws MappingRegistryException
     *
     * {@inheritDoc}
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            throw new MappingRegistryException(static::class . ": offset - $offset not registered yet");
        }

        return $this->container[$offset];
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value): void
    {
        $this->container[$offset] = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }
}