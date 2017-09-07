<?php
namespace Oraoto\Imp\Statement;

use Oraoto\Imp\Node\BinaryNodeConstructor;

class AssigmentStatement
{

    public $cond;
    public $on_true;

    public $on_false;

    public function construct($cond, $on_true, $on_false)
    {
        $this->cond = $cond;
        $this->on_true = $on_true;
        $this->on_false = $on_false;
    }

    public function eval($env)
    {
        $c = $this->cond->eval($env);
        if ($c) {
            $this->on_true->eval($env);
        } else {
            $this->on_false->eval($env);
        }
    }
}
