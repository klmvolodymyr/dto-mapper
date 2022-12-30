<?php

namespace DataMapper\Hydrator;

use DataMapper\NamingStrategy\NamingStrategyInterface;
use DataMapper\Strategy\StrategyInterface;

class HydratorBuilder implements HydratorBuilderInterface
{
    /**
     * @var AbstractHydrator
     */
    private $hydrator;

    private function __construct(AbstractHydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    public static function create(AbstractHydrator $hydrator): HydratorBuilderInterface
    {
        return new self($hydrator);
    }

    /**
     * {@inheritDoc}
     */
    public function addStrategy(string $name, StrategyInterface $strategy): void
    {
        $this->hydrator->addStrategy($name, $strategy);
    }

    /**
     * {@inheritDoc}
     */
    public function setNamingStrategy(NamingStrategyInterface $namingStrategy): void
    {
        $this->hydrator->setNamingStrategy($namingStrategy);
    }

    /**
     * {@inheritDoc}
     */
    public function removeNamingStrategy(): void
    {
        $this->hydrator->removeNamingStrategy();
    }

    /**
     * {@inheritDoc}
     */
    public function removeStrategy(string $name): void
    {
        $this->hydrator->removeStrategy($name);
    }

    /**
     * {@inheritDoc}
     */
    public function hasStrategy(string $name): bool
    {
        return $this->hydrator->hasStrategy($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getHydrator(): HydratorInterface
    {
        return $this->hydrator;
    }
}
