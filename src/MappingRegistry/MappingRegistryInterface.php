<?php

namespace DataMapper\MappingRegistry;

interface MappingRegistryInterface
{
    /**
     * @return ClassMappingRegistryInterface
     */
    public function getClassMappingRegistry(): ClassMappingRegistryInterface;

    /**
     * @return NamingStrategyRegistryInterface
     */
    public function getNamingRegistry(): NamingStrategyRegistryInterface;

    /**
     * @return StrategyRegistryInterface
     */
    public function getStrategyRegistry(): StrategyRegistryInterface;
}