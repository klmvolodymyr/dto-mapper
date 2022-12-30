<?php

namespace DataMapper\MappingRegistry;

interface ClassMappingRegistryInterface
{
    public function registerMappingClass(string $className): void;
    public function hasRegisteredMappingClass(string $className): bool;
    public function getAllRegisteredClasses(): array;
}