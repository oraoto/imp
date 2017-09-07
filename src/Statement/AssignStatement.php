<?php
namespace Oraoto\Imp\Statement;

use Oraoto\Imp\Node\BinaryNodeConstructor;

class AssignStatement extends Statement
{
    use BinaryNodeConstructor;

    public function eval($env)
    {
        $r = $this->right->eval($env);
        $l = $this->left->subNode;
        $env->add($l, $r);
    }
}
