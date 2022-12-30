<?php

namespace DataMapper\MappingRegistry;

class MappingRegistry implements MappingRegistryInterface
{
    /**
     * @var NamingStrategyRegistryInterface
     */
    private $namingRegistry;

    /**
     * @var StrategyRegistryInterface
     */
    private $strategyRegistry;

    /**
     * @var ClassMappingRegistryInterface
     */
    private $classMappingRegistry;

    /**
     * MappingRegistry constructor.
     *
     * @param ClassMappingRegistryInterface   $classMappingRegistry
     * @param NamingStrategyRegistryInterface $namingStrategyRegistry
     * @param StrategyRegistryInterface       $strategyRegistry
     */
    public function __construct(
        ClassMappingRegistryInterface $classMappingRegistry,
        NamingStrategyRegistryInterface $namingStrategyRegistry,
        StrategyRegistryInterface $strategyRegistry
    ) {
        $this->classMappingRegistry = $classMappingRegistry;
        $this->namingRegistry = $namingStrategyRegistry;
        $this->strategyRegistry = $strategyRegistry;
    }

    /**
     * @return ClassMappingRegistryInterface
     */
    public function getClassMappingRegistry(): ClassMappingRegistryInterface
    {
        return $this->classMappingRegistry;
    }

    /**
     * @return NamingStrategyRegistryInterface
     */
    public function getNamingRegistry(): NamingStrategyRegistryInterface
    {
        return $this->namingRegistry;
    }

    /**
     * @return StrategyRegistryInterface
     */
    public function getStrategyRegistry(): StrategyRegistryInterface
    {
        return $this->strategyRegistry;
    }
}