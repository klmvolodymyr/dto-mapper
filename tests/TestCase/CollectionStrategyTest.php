<?php

namespace Tests\TestCase;

use DataMapper\Hydrator\HydratorFactory;
use DataMapper\Mapper;
use DataMapper\MapperInterface;
use DataMapper\Strategy\CollectionStrategy;
use DataMapper\Type\TypeResolver;

use Tests\DataFixtures\Dto\AgeDto;
use Tests\DataFixtures\Dto\HumanDto;
use Tests\DataFixtures\Dto\WeightDto;
use Tests\DataFixtures\Model\CollectionRoot;
use Tests\DataFixtures\Traits\BaseMappingTrait;

use PHPUnit\Framework\TestCase;

class CollectionStrategyTest extends TestCase
{
    use BaseMappingTrait;

    public function testObjectConvert(): void
    {
        $source = new CollectionRoot();
        $mapper = $this->createMapper();
        $dto = $mapper->convert($source, HumanDto::class);
        $this->assertInstanceOf(HumanDto::class, $dto);
        $this->assertInstanceOf(AgeDto::class, $dto->nodeB);
        $this->assertInstanceOf(WeightDto::class, $dto->nodeA);
        $this->assertContainsOnlyInstancesOf(AgeDto::class, $dto->nodeC);
    }

    protected function createMapper(): MapperInterface
    {
        $mappingRegistry = $this->createMappingRegistry();
        $hydrationRegistry = $this->createHydrationRegistry();
        $factory = new HydratorFactory($hydrationRegistry, $mappingRegistry);
        $mapper = new Mapper($factory);

        $mappingRegistry
            ->getClassMappingRegistry()
            ->registerMappingClass(HumanDto::class);

        $mappingRegistry
            ->getClassMappingRegistry()
            ->registerMappingClass(WeightDto::class);

        $mappingRegistry
            ->getClassMappingRegistry()
            ->registerMappingClass(AgeDto::class);

        $mappingRegistry
            ->getStrategyRegistry()
            ->registerPropertyStrategy(
                TypeResolver::getStrategyType(CollectionRoot::class, HumanDto::class),
                'nodeA',
                new CollectionStrategy($mapper, WeightDto::class, false)
            );

        $mappingRegistry
            ->getStrategyRegistry()
            ->registerPropertyStrategy(
                TypeResolver::getStrategyType(CollectionRoot::class, HumanDto::class),
                'nodeB',
                new CollectionStrategy($mapper, AgeDto::class, false)
            );

        $mappingRegistry
            ->getStrategyRegistry()
            ->registerPropertyStrategy(
                TypeResolver::getStrategyType(CollectionRoot::class, HumanDto::class),
                'nodeC',
                new CollectionStrategy($mapper, AgeDto::class, true)
            );

        return $mapper;
    }
}