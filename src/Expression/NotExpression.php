<?php
namespace Oraoto\Imp\Expression;

use Oraoto\Imp\Node\UnaryNodeConstructor;

class NotExpression extends BooleanExpression
{
    use UnaryNodeConstructor;

    public function eval($env)
    {
        return !$this->subNode->eval($env);
    }
}
