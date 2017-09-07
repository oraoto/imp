<?php

namespace Oraoto\Imp\Node;

trait BinaryNodeConstructor
{
    public $left;
    public $right;

    public function __construct($left, $right)
    {
        $this->left = $left;
        $this->right = $right;
    }
}
