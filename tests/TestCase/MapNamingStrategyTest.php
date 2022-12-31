<?php

namespace Tests\TestCase;

use DataMapper\Hydrator\HydratorFactory;
use DataMapper\Hydrator\HydratorInterface;
use DataMapper\Type\TypeResolver;
use Tests\DataFixtures\Dto\NewClientDto;
use Tests\DataFixtures\Model\RegistrationResponseDto;
use Tests\DataFixtures\Traits\BaseMappingTrait;

use PHPUnit\Framework\TestCase;

class MapNamingStrategyTest extends TestCase
{
    use BaseMappingTrait;

    public function testMapNamingStrategy(): void
    {
        $mapping = [
            'firstName' => 'newFirstName',
            'lastName' =>  'newLastName',
        ];

        $source = new RegistrationResponseDto();
        $hydrator = $this->createHydrator(
            $source,
            NewClientDto::class,
            $mapping
        );
        /** @var NewClientDto $dto */
        $dto = $hydrator->hydrate($source, NewClientDto::class);
        $this->assertEquals($source->getFirstName(), $dto->newFirstName);
        $this->assertEquals($source->getLastName(), $dto->newLastName);
    }

    protected function createHydrator(object $source, string $destinationClass, array $mapping): HydratorInterface
    {
        $mappingRegistry = $this->createMappingRegistry();
        $hydrationRegistry = $this->createHydrationRegistry();
        $strategyKey = TypeResolver::getStrategyType($source, $destinationClass);

        $mappingRegistry
            ->getNamingRegistry()
            ->registerNamingStrategy(
                $strategyKey,
                $this->createMapNamingStrategy(
                    $mapping,
                    null
                )
            );

        return (new HydratorFactory($hydrationRegistry, $mappingRegistry))
            ->createHydrator($source, $destinationClass);
    }
}