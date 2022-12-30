<?php

namespace DataMapper\NamingStrategy;

interface NamingStrategyEnabledInterface
{
    public function setNamingStrategy(): void;
    public function getNamingStrategy(): ?NamingStrategyInterface;
    public function hasNamingStrategy(): bool;
    public function removeNamingStrategy(): void;
}