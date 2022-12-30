<?php

namespace DataMapper\Hydrator;

use DataMapper\Exception\InvalidArgumentException;

interface HydrationInterface
{
    /**
     * @throws InvalidArgumentException
     *
     * @param array|object          $source
     * @param object|string|array   $destination
     *
     * @return array|object
     */
    public function hydrate($source, $destination);
}