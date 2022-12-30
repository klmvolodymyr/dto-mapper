<?php

namespace DataMapper;

use DataMapper\Hydrator\HydratorInterface;

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