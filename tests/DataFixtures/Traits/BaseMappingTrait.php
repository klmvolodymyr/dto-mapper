<?php

namespace Tests\DataFixtures\Traits;

use DataMapper\Hydrator;
use DataMapper\NamingStrategy;
use DataMapper\MappingRegistry;
use DataMapper\Type\TypeDict;

trait BaseMappingTrait
{
    protected function createHydrationRegistry(): MappingRegistry\HydratorRegistry
    {
        $objectHydrator = $this->createObjectHydrator();
        $arraySerializerHydrator = $this->createArraySerializableHydrator();
        $arrayCollectionHydrator = $this->createArrayCollectionHydrator();

        $hydrationRegistry = new MappingRegistry\HydratorRegistry();
        $hydrationRegistry->registerHydrator($arrayCollectionHydrator, TypeDict::ARRAY_TO_CLASS);
        $hydrationRegistry->registerHydrator($arrayCollectionHydrator, TypeDict::ARRAY_TO_OBJECT);
        $hydrationRegistry->registerHydrator($arraySerializerHydrator, TypeDict::OBJECT_TO_ARRAY);
        $hydrationRegistry->registerHydrator($arraySerializerHydrator, TypeDict::ARRAY_TO_ARRAY);
        $hydrationRegistry->registerHydrator($objectHydrator, TypeDict::OBJECT_TO_CLASS);
        $hydrationRegistry->registerHydrator($objectHydrator, TypeDict::OBJECT_TO_OBJECT);

        return $hydrationRegistry;
    }

    protected function createObjectHydrator(): Hydrator\AbstractHydrator
    {
        return new Hydrator\ObjectHydrator($this->createHydratedClassesFactory());
    }

    protected function createArraySerializableHydrator(): Hydrator\AbstractHydrator
    {
        return new Hydrator\ArraySerializableHydrator($this->createHydratedClassesFactory());
    }

    protected function createArrayCollectionHydrator(): Hydrator\AbstractHydrator
    {
        return new Hydrator\ArrayCollectionHydrator($this->createHydratedClassesFactory());
    }

    public function createHydratedClassesFactory(): Hydrator\HydratedClassesFactory
    {
        return new Hydrator\HydratedClassesFactory(null);
    }

    protected function createMappingRegistry(): MappingRegistry\MappingRegistry
    {
        return new MappingRegistry\MappingRegistry(
            new MappingRegistry\ClassMappingRegistry(),
            new MappingRegistry\NamingStrategyRegistry(),
            new MappingRegistry\StrategyRegistry()
        );
    }

    protected function createUnderscoreNamingStrategy(): NamingStrategy\NamingStrategyInterface
    {
        return new NamingStrategy\UnderscoreNamingStrategy();
    }

    protected function createSnakeCaseNamingStrategy(): NamingStrategy\NamingStrategyInterface
    {
        return new NamingStrategy\SnakeCaseNamingStrategy();
    }

    protected function createMapNamingStrategy(array $mapping, ?array $reverse): NamingStrategy\NamingStrategyInterface {
        return new NamingStrategy\MapNamingStrategy($mapping, $reverse);
    }
}