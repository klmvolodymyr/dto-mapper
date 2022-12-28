<?php

namespace DataMapper\Hydrator;

interface ExtractionInterface
{
    public function extract(object $type): array;
}