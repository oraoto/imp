<?php
namespace Oraoto\Imp\Statement;

use Oraoto\Imp\Exception\EvalException;

class Statement
{
    public function eval($env)
    {
        throw new EvalException();
    }
}
