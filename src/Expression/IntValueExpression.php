<?php
namespace Oraoto\Imp\Expression;

use Oraoto\Imp\Node\ValueNodeConstructor;

class IntValueExpression extends ArithmeticExpression
{
    use ValueNodeConstructor;

    public function eval($env)
    {
        return $this->value;
    }
}
