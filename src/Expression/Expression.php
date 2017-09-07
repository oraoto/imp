<?php
namespace Oraoto\Imp\Expression;

use Oraoto\Imp\Exception\EvalException;

class Expression
{
    public function eval($env)
    {
        throw new EvalException("class Expression can't eval()");
    }
}
