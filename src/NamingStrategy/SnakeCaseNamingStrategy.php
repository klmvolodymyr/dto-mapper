<?php

namespace DataMapper\NamingStrategy;

class SnakeCaseNamingStrategy implements NamingStrategyInterface
{
    /**
     * {@inheritDoc}
     */
    public function hydrate(string $name, $context = null): string
    {
        return $this->format($name);
    }

    public function extract(string $name): string
    {
        return $this->format($name);
    }

    private function format(string $string): string
    {
        $string = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
        $string[0] = strtolower($string[0]);

        return $string;
    }
}