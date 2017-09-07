<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Oraoto\Imp\Environment;
use Oraoto\Imp\Tokenizer;
use Oraoto\Imp\Parser;
use Oraoto\Imp\Statement;

class ParserTest extends TestCase
{
    public function testSkip()
    {
        $input = "skip";
        [$stmt, $env] = $this->parse($input);
        $this->assertInstanceOf(Statement\SkipStatement::class, $stmt);
    }

    public function testSequence()
    {
        $input = "skip;";
        [$stmt, $env] = $this->parse($input);
        $this->assertInstanceOf(Statement\SequenceStatement::class, $stmt);

        $input = "skip;skip;skip;skip";
        [$stmt, $env] = $this->parse($input);
        $this->assertInstanceOf(Statement\SequenceStatement::class, $stmt);
    }

    public function testAssign()
    {
        $input = "a := 1";
        [$stmt, $env] = $this->parse($input);
        $this->assertInstanceOf(Statement\AssignStatement::class, $stmt);
        $this->assertEquals($env->find('a'), 1);
    }

    public function testArithmetic()
    {
        $input = "a := 1 + 6 / 3 + 5; b := a + 1";
        [$stmt, $env] = $this->parse($input);
        // $this->assertInstanceOf(Statement\SequenceStatement::class, $stmt);
        // $this->assertEquals($env->find('a'), 8);
        // $this->assertEquals($env->find('b'), 7);
    }

    private function parse($input)
    {
        $env    = new Environment();
        $tokens = (new Tokenizer())->tokenize($input);
        $stmt   = (new Parser())->parse($tokens);
        // var_dump($stmt);
        $stmt->eval($env);
        return [$stmt, $env];
    }
}
