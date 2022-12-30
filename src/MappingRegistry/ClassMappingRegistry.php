<?php

namespace DataMapper\MappingRegistry;

use DataMapper\Util\RegistryContainer;

final class ClassMappingRegistry extends RegistryContainer implements ClassMappingRegistryInterface
{
    public function registerMappingClass(string $className): void
    {
        $this->offsetSet($className, $className);
    }

    public function hasRegisteredMappingClass(string $className): bool
    {
        return $this->offsetExists($className);
    }

    public function getAllRegisteredClasses(): array
    {
        return $this->container;
    }
}