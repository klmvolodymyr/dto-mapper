<?php

namespace Tests\DataFixtures\Model;

class RegistrationResponseDto
{
    public string $firstName = 'Ivan';
    public string $lastName = 'Ivanov';
    public string $password = 'strpass';
    public string $city = 'Kiev';
    public string $country = 'Ukraine';
    public string $email = 'ivan@gmail.com';
    public string $birthday = '20/12/01';
    public array $personalInfo = [
        'a_a' => 1,
        'b_b' => 2,
    ];

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBirthday(): string
    {
        return $this->birthday;
    }

    public function getPersonalInfo(): array
    {
        return $this->personalInfo;
    }
}