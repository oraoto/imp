<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Oraoto\Imp\Environment;
use Oraoto\Imp\Expression\AddExpression;
use Oraoto\Imp\Expression\AndExpression;
use Oraoto\Imp\Expression\IntValueExpression;
use Oraoto\Imp\Expression\BoolValueExpression;
use Oraoto\Imp\Expression\IdentifierExpression;
use Oraoto\Imp\Expression\DivExpression;
use Oraoto\Imp\Expression\LessOrEqualExpression;
use Oraoto\Imp\Expression\NotExpression;

class ExpressionTest extends TestCase
{
    public function testAddTwoIntExpression()
    {
        $env = new Environment();
        $int1 = new IntValueExpression(1);
        $int2 = new IntValueExpression(2);
        $expr = new AddExpression($int1, $int2);
        $this->assertEquals($expr->eval($env), 3);
    }

    public function testAndExpression()
    {
        $env = new Environment();
        $t = new BoolValueExpression(true);
        $f = new BoolValueExpression(false);

        $expr = new AndExpression($t, $f);
        $this->assertEquals($expr->eval($env), false);

        $expr = new AndExpression($t, $t);
        $this->assertEquals($expr->eval($env), true);
    }

    public function testDivTwoIntExpression()
    {
        $env = new Environment();
        $int1 = new IntValueExpression(1);
        $int2 = new IntValueExpression(2);
        $int3 = new IntValueExpression(3);

        $expr = new DivExpression($int2, $int1);
        $this->assertEquals($expr->eval($env), 2);

        $expr = new DivExpression($int3, $int2);
        $this->assertEquals($expr->eval($env), 1);
    }

    public function testLessOrEuqalExpression()
    {
        $env = new Environment();
        $int1 = new IntValueExpression(1);
        $int2 = new IntValueExpression(2);
        $int3 = new IntValueExpression(3);

        $expr = new LessOrEqualExpression($int2, $int1);
        $this->assertEquals($expr->eval($env), false);

        $expr = new LessOrEqualExpression($int2, $int2);
        $this->assertEquals($expr->eval($env), true);

        $expr = new LessOrEqualExpression($int1, $int2);
        $this->assertEquals($expr->eval($env), true);
    }

    public function testIdentifierExpression()
    {
        $env = new Environment();
        $env->add("x", 1);
        $expr = new IdentifierExpression("x");
        $this->assertEquals($expr->eval($env), 1);
    }

    public function testNotExpression()
    {
        $env = new Environment();
        $int1 = new IntValueExpression(1);
        $int2 = new IntValueExpression(2);
        $t = new BoolValueExpression(true);
        $f = new BoolValueExpression(false);

        $le = new LessOrEqualExpression($int2, $int1);
        $expr = new NotExpression($le);
        $this->assertEquals($expr->eval($env), true);

        $this->assertEquals((new NotExpression($t))->eval($env), false);
        $this->assertEquals((new NotExpression($f))->eval($env), true);
    }
}
