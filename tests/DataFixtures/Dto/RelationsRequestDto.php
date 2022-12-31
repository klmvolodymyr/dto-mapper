<?php

namespace Tests\DataFixtures\Dto;

class RelationsRequestDto
{
    /**
     * @var RegistrationRequestDto[]
     */
    public $registrationsRequests = [];

    /**
     * @var PersonalInfoDto
     */
    public $personalInfo;
    public array $extra = [];

    /**
     * @return RegistrationRequestDto[]
     */
    public function getRegistrationsRequests(): array
    {
        return $this->registrationsRequests;
    }

    public function getPersonalInfo(): PersonalInfoDto
    {
        return $this->personalInfo;
    }

    public function getExtra(): array
    {
        return $this->extra;
    }
}