<?php

namespace Oraoto\Imp\Node;

trait UnaryNodeConstructor
{
    public $subNode;

    public function __construct($subNode)
    {
        $this->subNode = $subNode;
    }

    public function getSubNode()
    {
        return $this->subNode;
    }
}
