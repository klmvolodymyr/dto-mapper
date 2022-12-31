<?php

namespace Tests\DataFixtures\Model;

class Bill
{
    private int $amount = 10;
    private string $copiedByName = 'ok';
    private $bill;

    public function getFormattedAmount(): string
    {
        return $this->amount . ' USD';
    }

    public function getCopiedByName(): string
    {
        return $this->copiedByName;
    }
}