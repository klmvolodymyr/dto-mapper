<?php

namespace DataMapper\MappingRegistry;

use DataMapper\NamingStrategy\NamingStrategyInterface;
use DataMapper\MappingRegistry\Exception\MappingRegistryException;

interface NamingStrategyRegistryInterface
{
    public function getRegisteredNamingStrategyFor(string $key): ?NamingStrategyInterface;
    public function hasRegisteredNamingStrategyFor(string $key): bool;
    public function registerNamingStrategy(string $key, NamingStrategyInterface $strategy): void;
}