<?php

namespace DataMapper\Hydrator;

use DataMapper\MappingRegistry\HydratorRegistryInterface;
use DataMapper\MappingRegistry\MappingRegistryInterface;
use DataMapper\Type\TypeResolver;

class HydratorFactory implements HydratorFactoryInterface
{
    /**
     * @var HydratorRegistryInterface
     */
    private $hydratorRegistry;

    /**
     * @var MappingRegistryInterface
     */
    private $mappingRegistry;

    public function __construct(
        HydratorRegistryInterface $hydratorRegistry,
        MappingRegistryInterface $mappingRegistry
    ) {
        $this->hydratorRegistry = $hydratorRegistry;
        $this->mappingRegistry = $mappingRegistry;
    }

    public function createHydrator($source, $destination): HydratorInterface
    {
        $strategyKey = TypeResolver::getStrategyType($source, $destination);
        $type = TypeResolver::getHydratedType($source, $destination);
        /** @var AbstractHydrator $hydrator */
        $hydrator = $this->hydratorRegistry->getHydratorByType($type);
        $hBuilder = HydratorBuilder::create($hydrator);

        $hydrationStrategies = $this
            ->mappingRegistry
            ->getStrategyRegistry()
            ->loadRegisteredStrategiesFor($strategyKey);

        $namingStrategy = $this
            ->mappingRegistry
            ->getNamingRegistry()
            ->getRegisteredNamingStrategyFor($strategyKey);

        if ($namingStrategy !== null) {
            $hBuilder->setNamingStrategy($namingStrategy);
        }

        foreach ($hydrationStrategies as $name => $strategy) {
            $hBuilder->addStrategy($name, $strategy);
        }

        return $hBuilder->getHydrator();
    }
}