<?php
namespace Oraoto\Imp\Statement;

use Oraoto\Imp\Node\BinaryNodeConstructor;

class WhileStatement extends Statement
{
    use BinaryNodeConstructor;

    public function eval($env)
    {
        while (true) {
            $c = $this->left->eval($env);
            if ($c) {
                $this->right->eval($env);
            } else {
                break;
            }
        }
    }
}
