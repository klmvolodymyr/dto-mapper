<?php

namespace Tests\DataFixtures\Model;

class Outer
{
    private $inner;
    private int $destinationGetterTarget = 100;
    public string $copiedByName = 'ok';
    public $found;
    public $test;

    public function __construct()
    {
        $this->inner = new Inner();
    }

    public function getInner(): Inner
    {
        return $this->inner;
    }

    public function getTestGetter(): int
    {
        return $this->destinationGetterTarget;
    }

    public function getCopiedByName(): string
    {
        return $this->copiedByName;
    }
}