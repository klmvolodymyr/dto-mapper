<?php

namespace Tests\TestCase;

use DataMapper\Hydrator\HydratorFactory;
use DataMapper\Hydrator\HydratorInterface;

use DataMapper\Type\TypeResolver;
use Tests\DataFixtures\Model\RegistrationResponseDto;
use Tests\DataFixtures\Traits\BaseMappingTrait;

use PHPUnit\Framework\TestCase;

class ObjectExtractionTest extends TestCase
{
    use BaseMappingTrait;

    public function testObjectToUnderscoreArrayExtraction(): void
    {
        $dto = new RegistrationResponseDto();
        $hydrator = $this->createHydrator($dto);
        $extracted = $hydrator->extract($dto);

        $this->assertEquals($dto->getFirstName(), $extracted['first_name']);
        $this->assertEquals($dto->getLastName(), $extracted['last_name']);
        $this->assertEquals($dto->getPassword(), $extracted['password']);
        $this->assertEquals($dto->getCity(), $extracted['city']);
        $this->assertEquals($dto->getCountry(), $extracted['country']);
        $this->assertEquals($dto->getEmail(), $extracted['email']);
        $this->assertEquals($dto->getBirthday(), $extracted['birthday']);
        $this->assertEquals($dto->getPersonalInfo(), $extracted['personal_info']);
    }

    protected function createHydrator(object $source): HydratorInterface
    {
        $mappingRegistry = $this->createMappingRegistry();
        $hydrationRegistry = $this->createHydrationRegistry();
        $strategyKey = TypeResolver::getStrategyType($source, []);

        $mappingRegistry
            ->getNamingRegistry()
            ->registerNamingStrategy(
                $strategyKey,
                $this->createUnderscoreNamingStrategy()
            );

        return (new HydratorFactory($hydrationRegistry, $mappingRegistry))->createHydrator($source, []);
    }
}