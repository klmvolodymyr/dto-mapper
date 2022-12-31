<?php

namespace Tests\DataFixtures\Model;

class CollectionRoot
{
    /**
     * @var CollectionNode
     */
    public $nodeA;

    /**
     * @var CollectionNode
     */
    public $nodeB;

    /**
     * @var CollectionNode[]
     */
    public array $nodeC = [];

    /**
     * CollectionRoot constructor.
     */
    public function __construct()
    {
        $this->nodeA = new CollectionNode();
        $this->nodeB = new CollectionNode();
        $this->nodeC = [
            new CollectionNode(),
            new CollectionNode(),
        ];
    }
}