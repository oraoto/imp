<?php
namespace Oraoto\Imp\Expression;

use Oraoto\Imp\Node\UnaryNodeConstructor;

class IdentifierExpression extends ArithmeticExpression
{
    use UnaryNodeConstructor;

    public function eval($env)
    {
        return $env->find($this->subNode);
    }
}
