<?php
namespace Oraoto\Imp\Expression;

use Oraoto\Imp\Node\BinaryNodeConstructor;

class DivExpression extends ArithmeticExpression
{
    use BinaryNodeConstructor;

    public function eval($env)
    {
        return floor($this->left->eval($env) / $this->right->eval($env));
    }
}
