<?php

namespace DataMapper\NamingStrategy;

class UnderscoreNamingStrategy implements NamingStrategyInterface
{
    /**
     * {@inheritDoc}
     */
    public function hydrate(string $name, $context = null): string
    {
        return $this->format($name);
    }

    /**
     * {@inheritDoc}
     */
    public function extract(string $name): string
    {
        return $this->format($name);
    }

    private function format(string $str): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $str));
    }
}