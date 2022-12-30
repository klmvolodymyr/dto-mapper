<?php

namespace DataMapper\NamingStrategy;

interface NamingStrategyInterface
{
    public function hydrate(string $name, $context = null): string;
    public function extract(string $name): string;
}