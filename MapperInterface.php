<?php

namespace DataMapper;

interface MapperInterface
{
    /**
     * @param array|object          $source
     * @param object|string|array   $destination
     *
     * @return object|array
     */
    public function convert($source, $destination);

    public function convertCollection(iterable $sources, string  $destination): iterable;

    public function extract(object $source): array;
}