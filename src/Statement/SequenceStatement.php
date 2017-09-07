<?php
namespace Oraoto\Imp\Statement;

use Oraoto\Imp\Node\BinaryNodeConstructor;

class SequenceStatement extends Statement
{
    use BinaryNodeConstructor;

    public function eval($env)
    {
        $this->left  ? $this->left->eval($env)  : '';
        $this->right ? $this->right->eval($env) : '';
    }
}
