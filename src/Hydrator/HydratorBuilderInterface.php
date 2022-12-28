<?php

namespace DataMapper\Hydrator;

use DataMapper\NamingStrategy\NamingStrategyInterface;
use DataMapper\Strategy\StrategyInterface;

interface HydratorBuilderInterface
{
    public function setNamingStrategy(NamingStrategyInterface $namingStrategy): void;
    public function addStrategy(string $name, StrategyInterface $strategy): void;
    public function removeNamingStrategy(): void;
    public function removeStrategy(string $name): void;
    public function hasStrategy(string $name): bool;
    public function getHydrator(): HydratorInterface;
}