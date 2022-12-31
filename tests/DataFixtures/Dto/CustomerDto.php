<?php

namespace Tests\DataFixtures\Dto;

class CustomerDto
{
    private string $bill = '00.00';
    public $copiedByName;

    public function getBill(): string
    {
        return $this->bill;
    }

    public function getCopiedByName()
    {
        return $this->copiedByName;
    }
}