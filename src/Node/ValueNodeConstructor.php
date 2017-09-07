<?php

namespace Oraoto\Imp\Node;

trait ValueNodeConstructor
{
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
