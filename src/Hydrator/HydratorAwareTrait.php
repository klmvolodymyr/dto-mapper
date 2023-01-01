<?php

namespace DataMapper\Hydrator;

trait HydratorAwareTrait {

    protected $hydrator;

    public function getHydrator(): ?HydratorInterface
    {
        return $this->hydrator;
    }

    public function setHydrator(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;

        return $this;
    }
}