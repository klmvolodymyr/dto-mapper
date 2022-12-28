<?php

namespace DataMapper\Hydrator;

use GeneratedHydrator\Configuration;

class HydratedClassesFactory
{
    private string $targetDir = '.';

    public function __construct(?string $targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function createHydratorClass(string $className): object
    {
        $hydratedClassName = $this->extractHydratedClass($className);

        return new $hydratedClassName();
    }

    public function extractHydratedClass(string $className): string
    {
        $hydratedClassName = $this->extractHydratedClass($className);

        return new $hydratedClassName();
    }
}