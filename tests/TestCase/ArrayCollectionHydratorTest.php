<?php

namespace Tests\TestCase;

use DataMapper\Hydrator\HydratorFactory;
use DataMapper\Hydrator\HydratorInterface;
use DataMapper\Mapper;
use DataMapper\MapperInterface;
use DataMapper\Strategy\CollectionStrategy;
use DataMapper\Type\TypeResolver;

use Tests\DataFixtures\Dto\PersonalInfoDto;
use Tests\DataFixtures\Dto\RegistrationRequestDto;
use Tests\DataFixtures\Dto\RelationsRequestDto;
use Tests\DataFixtures\Traits\BaseMappingTrait;

use PHPUnit\Framework\TestCase;

class ArrayCollectionHydratorTest extends TestCase
{
    use BaseMappingTrait;

    /**
     * @dataProvider registrationDataProvider
     */
    public function testArrayToDtoMapping(array $parameters, array $relations): void
    {
        /** @var RelationsRequestDto $dto */
        $mapper = $this->createHydrator($parameters, RelationsRequestDto::class, $relations);

        $dto = $mapper->convert($parameters, RelationsRequestDto::class);

        $this->assertRegistrationData($parameters['registrations_requests'][0], $dto->getRegistrationsRequests()[0]);
        $this->assertRegistrationData($parameters['registrations_requests'][1], $dto->getRegistrationsRequests()[1]);
        $this->assertEquals($parameters['personal_info']['code_word'], $dto->getPersonalInfo()->getCodeWord());
        $this->assertEquals($parameters['personal_info']['gender'], $dto->getPersonalInfo()->getGender());
        $this->assertEquals($parameters['personal_info']['phone'], $dto->getPersonalInfo()->getPhone());
        $this->assertEquals($parameters['extra'], $dto->getExtra());
    }

    public function registrationDataProvider(): array
    {
        return [
            [
                [
                    'registrations_requests' => [
                        [
                            'first_name' => 'Ivan 1',
                            'last_name' => 'Ivanov 1',
                            'password' => 'ivanstrongpassword 1',
                            'city' => 'Kiev 1',
                            'country' => 'Ukraine 1',
                            'email' => 'ivan@gmail.com 1',
                            'birthday' => '2020/02//12 1',
                            'personal_info' => [
                                'a_a' => 1,
                                'b_b' => 2,
                            ],
                        ],
                        [
                            'first_name' => 'Ivan 2',
                            'last_name' => 'Ivanov 2',
                            'password' => 'ivanstrongpassword 2',
                            'city' => 'Kiev 2',
                            'country' => 'Ukraine 2',
                            'email' => 'ivan@gmail.com 2',
                            'birthday' => '2020/02//12 2',
                            'personal_info' => [
                                'a_a' => 1,
                                'b_b' => 2,
                            ],
                        ],
                    ],
                    'personal_info' => [
                        'code_word' => 'secret',
                        'gender' => 'male',
                        'phone' => 'xxxxxxxx',
                    ],
                    'extra' => [
                        'extra_1' => 1,
                        'extra_2' => 2,
                    ],
                ],
                [
                    [
                        'registrationsRequests',
                        RegistrationRequestDto::class,
                        true,
                    ],
                    [
                        'personalInfo',
                        PersonalInfoDto::class,
                        false
                    ],
                ]
            ]
        ];
    }

    protected function createHydrator(array $source, string $className, array $mappingProps): MapperInterface
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

        $factory = new HydratorFactory($hydrationRegistry, $mappingRegistry);
        $mapper = new Mapper($factory);

        foreach ($mappingProps as [$prop, $target, $multi]) {
            $mappingRegistry
                ->getStrategyRegistry()
                ->registerPropertyStrategy($strategyKey, $prop, new CollectionStrategy($mapper, $target, $multi));

            $mappingRegistry
                ->getNamingRegistry()
                ->registerNamingStrategy(
                    TypeResolver::getStrategyType($source, $target),
                    $this->createSnakeCaseNamingStrategy()
                );
        }

//        $factory = (new HydratorFactory($hydrationRegistry, $mappingRegistry))->createHydrator($source, $className);

        return new Mapper(new HydratorFactory($hydrationRegistry, $mappingRegistry));
    }

    private function assertRegistrationData(array $registrationData, RegistrationRequestDto $dto): void
    {
        $this->assertEquals($dto->getFirstName(), $registrationData['first_name']);
        $this->assertEquals($dto->getLastName(), $registrationData['last_name']);
        $this->assertEquals($dto->getPassword(), $registrationData['password']);
        $this->assertEquals($dto->getCity(), $registrationData['city']);
        $this->assertEquals($dto->getCountry(), $registrationData['country']);
        $this->assertEquals($dto->getEmail(), $registrationData['email']);
        $this->assertEquals($dto->getBirthday(), $registrationData['birthday']);
    }
}