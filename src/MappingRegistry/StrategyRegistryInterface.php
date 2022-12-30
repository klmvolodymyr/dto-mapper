<?php

namespace DataMapper\MappingRegistry;

use DataMapper\MappingRegistry\Exception\MappingRegistryException;
use DataMapper\Strategy\StrategyInterface;

interface StrategyRegistryInterface
{
    /**
     * @param string $key
     * @param string $property
     *
     * @return bool
     */
    public function hasRegisteredPropertyStrategy(string $key, string $property): bool;

    /**
     * @param string $key
     *
     * @return array ['ClassAName#ClassBName' => StrategyInterface .. etc]
     */
    public function loadRegisteredStrategiesFor(string $key): array;

    /**
     * @throws MappingRegistryException
     *
     * @param string            $key
     * @param string            $property
     * @param StrategyInterface $strategy
     *
     * @return void
     */
    public function registerPropertyStrategy(string $key, string $property, StrategyInterface $strategy): void;
}