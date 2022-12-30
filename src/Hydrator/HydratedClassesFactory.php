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
        $config = new Configuration($className);

        if (null !== $this->targetDir) {
            $config->setGeneratedClassesTargetDir($this->targetDir);
            \spl_autoload_register($config->getGeneratedClassAutoloader());
        }

        $hydratedClassName = $config->createFactory()->getHydratorClass();

        return $hydratedClassName;
    }
}