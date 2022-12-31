<?php

namespace Tests\DataFixtures\Dto;

class PersonalInfoDto
{
    public $codeWord;
    public $gender;
    public $phone;

    public function getCodeWord()
    {
        return $this->codeWord;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getPhone()
    {
        return $this->phone;
    }
}