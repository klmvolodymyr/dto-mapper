<?php

namespace DataMapper;

interface MapperInterface
{
    /**
     * @param array|object        $source
     * @param object|string|array $destination
     *
     * @return object|array
     */
    public function convert($source, $destination);

    /**
     * @param iterable $sources
     * @param string   $destination
     *
     * @return iterable
     */
    public function convertCollection(iterable $sources, string $destination): iterable;

    /**
     * @param object $source
     *
     * @return array
     */
    public function extract(object $source): array;
}