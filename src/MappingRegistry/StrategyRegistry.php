<?php

namespace DataMapper\MappingRegistry;

use DataMapper\MappingRegistry\Exception\MappingRegistryException;
use DataMapper\Strategy\StrategyInterface;
use DataMapper\Type\TypeDict;
use DataMapper\Type\TypeResolver;
use DataMapper\Util\RegistryContainer;

final class StrategyRegistry extends RegistryContainer implements StrategyRegistryInterface
{
    /**
     * {@inheritDoc}
     */
    public function hasRegisteredPropertyStrategy(string $key, string $property): bool
    {
        return $this->offsetExists($key) ? isset($this->offsetGet($key)[$property]) : false;
    }

    /**
     * {@inheritDoc}
     */
    public function loadRegisteredStrategiesFor(string $key): array
    {
        [$source, $destination] = \explode(TypeDict::STRATEGY_GLUE, $key);

        $registeredStrategies = [];
        $defaultStrategiesInjectData = [];
        $defaultStrategiesExtractData = [];
        $defaultStrategiesExtractKey = TypeResolver::implodeType(
            $source,
            TypeDict::ALL_TYPE,
            TypeDict::STRATEGY_GLUE
        );

        if ($this->offsetExists($key)) {
            $registeredStrategies = $this->offsetGet($key);
        }

        if ($this->offsetExists($defaultStrategiesExtractKey)) {
            $defaultStrategiesExtractData = $this->offsetGet($defaultStrategiesExtractKey);
        }

        $defaultStrategiesInjectKey = TypeResolver::implodeType(TypeDict::ALL_TYPE, $destination, TypeDict::STRATEGY_GLUE);

        if ($this->offsetExists($defaultStrategiesInjectKey)) {
            $defaultStrategiesInjectData = $this->offsetGet($defaultStrategiesInjectKey);
        }

        return \array_merge($defaultStrategiesExtractData, $defaultStrategiesInjectData, $registeredStrategies);
    }

    /**
     * {@inheritDoc}
     */
    public function registerPropertyStrategy(string $key, string $property, StrategyInterface $strategy): void
    {
        if ($this->hasRegisteredPropertyStrategy($key, $property)) {
            throw new MappingRegistryException("Property strategy already registered for: $key");
        }

        $value = [];
        if ($this->offsetExists($key)) {
            $value = $this->offsetGet($key);
        }

        $value[$property] = $strategy;
        $this->offsetSet($key, $value);
    }
}