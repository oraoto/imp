<?php
namespace Oraoto\Imp\Expression;

use Oraoto\Imp\Node\BinaryNodeConstructor;

class LessOrEqualExpression extends BooleanExpression
{
    use BinaryNodeConstructor;

    public function eval($env)
    {
        return $this->left->eval($env) <= $this->right->eval($env);
    }
}
