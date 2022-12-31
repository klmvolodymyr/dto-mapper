<?php

namespace Tests\DataFixtures\Model;

class Inner
{
    private $deep;

    public function __construct()
    {
        $this->deep = new Deep();
    }

    public function getDeep(): Deep
    {
        return $this->deep;
    }
}