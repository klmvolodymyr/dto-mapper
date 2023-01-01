<?php

namespace DataMapper\Strategy;

use DataMapper\Exception\InvalidArgumentException;
use DataMapper\MapperInterface;

class CollectionStrategy implements StrategyInterface
{
    /**
     * @var MapperInterface
     */
    private $mapper;

    /**
     * @var string
     */
    private $relationTargetClass;

    /**
     * @var bool
     */
    private $isCollection;

    /**
     * CollectionStrategy constructor.
     *
     * @throws InvalidArgumentException
     *
     * @param MapperInterface $mapper
     * @param string          $relationTargetClass
     * @param bool            $isCollection
     */
    public function __construct(MapperInterface $mapper, string $relationTargetClass, bool $isCollection)
    {
        if (!\class_exists($relationTargetClass)) {
            throw new InvalidArgumentException($relationTargetClass . ' - class is not exist.');
        }

        $this->mapper = $mapper;
        $this->relationTargetClass = $relationTargetClass;
        $this->isCollection = $isCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function hydrate($value, $context)
    {
        if (null === $value || !(\is_object($value) || \is_array($value))) {
            return $value;
        }

        if (false === $this->isCollection) {
            return $this->mapper->convert($value, $this->relationTargetClass);
        }

        if (\is_object($value) &&
            interface_exists('\Doctrine\Common\Collections\Collection') &&
            $value instanceof \Doctrine\Common\Collections\Collection
        ) {
            $value = $value->toArray();
        }

        return array_map(
            function ($item) {
                return $this->mapper->convert($item, $this->relationTargetClass);
            },
            $value
        );
    }
}