<?php

namespace DataMapper\MappingRegistry;

use DataMapper\Type\TypeDict;
use DataMapper\Util\RegistryContainer;
use DataMapper\NamingStrategy\NamingStrategyInterface;
use DataMapper\Type\TypeResolver;

final class NamingStrategyRegistry extends RegistryContainer implements NamingStrategyRegistryInterface
{
    /**
     * {@inheritDoc}
     */
    public function getRegisteredNamingStrategyFor(string $key): ?NamingStrategyInterface
    {
        return $this->offsetExists($key) ? $this->offsetGet($key): $this->loadDefaultNamingStrategy($key);
    }

    /**
     * {@inheritDoc}
     */
    public function hasRegisteredNamingStrategyFor(string $key): bool
    {
        return $this->offsetExists($key);
    }

    /**
     * {@inheritDoc}
     */
    public function registerNamingStrategy(string $key, NamingStrategyInterface $strategy): void
    {
        $this->offsetSet($key, $strategy);
    }

    /**
     * @param string $key
     *
     * @return NamingStrategyInterface|null
     */
    private function loadDefaultNamingStrategy(string $key): ?NamingStrategyInterface
    {
        [$source, $destination] = \explode(TypeDict::STRATEGY_GLUE, $key);

        if ($destination === TypeDict::ARRAY_TYPE) {
            $strategyKey = TypeResolver::getStrategyType($source, TypeDict::ALL_TYPE);
        } elseif ($source === TypeDict::ARRAY_TYPE) {
            $strategyKey = TypeResolver::getStrategyType(TypeDict::ALL_TYPE, $destination);
        } else {
            $strategyKey = TypeResolver::getStrategyType($source, TypeDict::ALL_TYPE);
        }

        return $this->offsetExists($strategyKey) ? $this->offsetGet($strategyKey) : null;
    }
}