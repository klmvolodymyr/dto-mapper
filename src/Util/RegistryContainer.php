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
        return \isset($this->container[$offset]);
    }

    /**
     * @throws MappingRegistryException
     *
     * {@inheritDoc}
     */
    public function offsetGet($offset)
    {

    }

}