<?php

namespace Tests\DataFixtures\Dto;

class RegistrationRequestDto
{
    public $firstName;
    public $lastName;
    public $password;
    public $city;
    public $country;
    public $email;
    public $birthday;
    public $personalInfo;

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function getPersonalInfo()
    {
        return $this->personalInfo;
    }
}