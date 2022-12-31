<?php

namespace Tests\DataFixtures\Model;

class Deep
{
    public const STR = 'find me';
    private string $searchValue = self::STR;

    public function getDeepValue(): string
    {
        return $this->searchValue;
    }
}