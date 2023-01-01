<?php

namespace DataMapper\NamingStrategy;

interface NamingStrategyEnabledInterface
{
    public function setNamingStrategy(NamingStrategyInterface $strategy): void;
    public function getNamingStrategy(): ?NamingStrategyInterface;
    public function hasNamingStrategy(): bool;
    public function removeNamingStrategy(): void;
}