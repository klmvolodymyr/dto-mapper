<?php

namespace Tests\TestCase;

use DataMapper\Hydrator\HydratorFactory;
use DataMapper\Hydrator\HydratorInterface;

use DataMapper\Type\TypeResolver;
use Tests\DataFixtures\Dto\RegistrationRequestDto;
use Tests\DataFixtures\Traits\BaseMappingTrait;

use PHPUnit\Framework\TestCase;

class ArrayToDtoHydrationTest extends TestCase
{
    use BaseMappingTrait;

    /**
     * @dataProvider registrationDataProvider
     */
    public function testArrayToDtoMapping(array $registrationData): void
    {
        $hydrator = $this->createArrayToClassHydrator(
            $registrationData,
            RegistrationRequestDto::class
        );
        $dto = $hydrator->hydrate($registrationData, RegistrationRequestDto::class);

        $this->assertEquals($dto->getFirstName(), $registrationData['first_name']);
        $this->assertEquals($dto->getLastName(), $registrationData['last_name']);
        $this->assertEquals($dto->getPassword(), $registrationData['password']);
        $this->assertEquals($dto->getCity(), $registrationData['city']);
        $this->assertEquals($dto->getCountry(), $registrationData['country']);
        $this->assertEquals($dto->getEmail(), $registrationData['email']);
        $this->assertEquals($dto->getBirthday(), $registrationData['birthday']);
        $this->assertEquals($dto->getPersonalInfo(), $registrationData['personal_info']);
    }

    public function registrationDataProvider(): array
    {
        return [
            [
                [
                    'first_name' => 'Ivan',
                    'last_name' => 'Ivanov',
                    'password' => 'ivanstrongpassword',
                    'city' => 'Kiev',
                    'country' => 'Ukraine',
                    'email' => 'ivan@gmail.com',
                    'birthday' => '2020/02//12',
                    'personal_info' => [
                        'a_a' => 1,
                        'b_b' => 2,
                    ],
                ],
            ],
            [
                [
                    'first_name' => null,
                    'last_name' => 2,
                    'password' => 'ivanstrongpassword',
                    'city' => null,
                    'country' => 'Ukraine',
                    'email' => 'ivan@gmail.com',
                    'birthday' => '2020/02//12',
                    'personal_info' => [
                        'a_a' => 1,
                        'b_b' => 2,
                    ],
                ],
            ],
        ];
    }

    protected function createArrayToClassHydrator(array $source, string $className): HydratorInterface
    {
        $mappingRegistry = $this->createMappingRegistry();
        $hydrationRegistry = $this->createHydrationRegistry();
        $strategyKey = TypeResolver::getStrategyType($source, $className);
        $mappingRegistry->getClassMappingRegistry()->registerMappingClass($className);
        $mappingRegistry
            ->getNamingRegistry()
            ->registerNamingStrategy($strategyKey, $this->createSnakeCaseNamingStrategy());

        return (new HydratorFactory($hydrationRegistry, $mappingRegistry))->createHydrator($source, $className);
    }
}