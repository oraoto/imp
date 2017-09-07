<?php

namespace Oraoto\Imp\Expression;

use Oraoto\Imp\Node\ValueNodeConstructor;

class BoolValueExpression extends BooleanExpression
{
    use ValueNodeConstructor;

    public function eval($env)
    {
        return $this->value;
    }
}
