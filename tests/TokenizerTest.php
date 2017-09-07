<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Oraoto\Imp\Tokenizer;

class TokenizerTest extends TestCase
{
    public function testCond()
    {
        $result = (new Tokenizer())->tokenize("x := 1;while 2 >= 1 do if 1 >= 10 then x:=2 else y:=3;");
    }
}
