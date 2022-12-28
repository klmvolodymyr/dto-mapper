<?php

namespace DataMapper\Hydrator;

interface HydratorFactoryInterface
{
    public function createHydrator($source, $destination): HydratorInterface;
}