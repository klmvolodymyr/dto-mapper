<?php

namespace Tests\TestCase;

use DataMapper\Hydrator\HydratorFactory;
use DataMapper\Mapper;
use DataMapper\MapperInterface;
use DataMapper\Type\TypeResolver;
use PHPUnit\Framework\TestCase;
use Tests\DataFixtures\Dto\RegistrationRequestDto;
use Tests\DataFixtures\Traits\BaseMappingTrait;

class ConvertCollectionTest extends TestCase
{
    use BaseMappingTrait;

    /**
     * @dataProvider registrationCollectionDataProvider
     */
    public function testCollectionConvertation(iterable $newUsers): void
    {
        $mapper = $this->createMapper($newUsers, RegistrationRequestDto::class);
        $result = $mapper->convertCollection($newUsers, RegistrationRequestDto::class);
        $this->assertContainsOnlyInstancesOf(RegistrationRequestDto::class, $result);
    }

    public function registrationCollectionDataProvider(): array
    {
        return [
            [
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
            ],
        ];
    }

    protected function createMapper(array $source, string $className): MapperInterface
    {
        $mappingRegistry = $this->createMappingRegistry();
        $hydrationRegistry = $this->createHydrationRegistry();
        $strategyKey = TypeResolver::getStrategyType($source, $className);

        $mappingRegistry
            ->getClassMappingRegistry()
            ->registerMappingClass($className);

        $mappingRegistry
            ->getNamingRegistry()
            ->registerNamingStrategy($strategyKey, $this->createSnakeCaseNamingStrategy());

        return new Mapper(new HydratorFactory($hydrationRegistry, $mappingRegistry));
    }
}