<?php

namespace Tests\TestCase;

use DataMapper\Hydrator\HydratorFactory;
use DataMapper\Hydrator\HydratorInterface;
use DataMapper\Strategy\ClosureStrategy;
use DataMapper\Type\TypeResolver;

use Tests\DataFixtures\Dto\DeepValueDto;
use Tests\DataFixtures\Model\Deep;
use Tests\DataFixtures\Model\Inner;
use Tests\DataFixtures\Model\Outer;
use Tests\DataFixtures\Traits\BaseMappingTrait;

use PHPUnit\Framework\TestCase;

class ClosureStrategyTest extends TestCase
{
    use BaseMappingTrait;

    public function testClosureStrategyHydration(): void
    {
        $outer = new Outer();
        $searchString = 'Returned from closure';
        $closure = function (Inner $inner) use ($searchString): string {
            return $inner->getDeep()->getDeepValue() . $searchString;
        };
        $hydrator = $this->createHydrator($outer, DeepValueDto::class, 'inner', [$closure],);

        $dto = $hydrator->hydrate($outer, DeepValueDto::class);
        $this->assertEquals(Deep::STR . $searchString, $dto->getInner());
        $this->assertEquals($dto->getCopiedByName(), $outer->getCopiedByName());
    }

    private function createHydrator(object $source, string $target, string $property, array $args): HydratorInterface
    {
        $mappingRegistry = $this->createMappingRegistry();
        $hydrationRegistry = $this->createHydrationRegistry();
        $strategyKey = TypeResolver::getStrategyType($source, $target);

        $mappingRegistry
            ->getClassMappingRegistry()
            ->registerMappingClass(\get_class($source));

        $mappingRegistry
            ->getClassMappingRegistry()
            ->registerMappingClass($target);

        $mappingRegistry
            ->getStrategyRegistry()
            ->registerPropertyStrategy($strategyKey, $property, new ClosureStrategy(...$args));

        return (new HydratorFactory($hydrationRegistry, $mappingRegistry))->createHydrator($source, $target);
    }
}