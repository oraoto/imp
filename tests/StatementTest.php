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
use Oraoto\Imp\Statement\AssignStatement;
use Oraoto\Imp\Statement\SkipStatement;
use Oraoto\Imp\Statement\SequenceStatement;
use Oraoto\Imp\Statement\WhileStatement;

class StatementTest extends TestCase
{
    public function testWhileStatement()
    {
        $env = new Environment();

        $x = new IdentifierExpression("x");
        $assign = new AssignStatement($x, new IntValueExpression(30));

        $int2 = new IntValueExpression(2);
        $expr = new DivExpression($x, $int2);
        $assign2 = new AssignStatement($x, $expr);

        $cond = new NotExpression(
            new LessOrEqualExpression(
                new IdentifierExpression("x"),
                new IntValueExpression(3)
            )
        );

        $whileStmt = new WhileStatement($cond, $assign2);

        $stmt = new SequenceStatement($assign, $whileStmt);

        $stmt->eval($env);

        $this->assertEquals($env->find("x"), 3);
    }

    public function testAssignStatement()
    {
        $env = new Environment();

        $stmt = new AssignStatement(new IdentifierExpression("x"), new IntValueExpression(1));
        $stmt->eval($env);

        $this->assertEquals($env->find("x"), 1);
    }

    public function testSequenceStatementExpression()
    {
        $env = new Environment();

        $stmt1 = new AssignStatement(new IdentifierExpression("x"), new IntValueExpression(1));
        $stmt2 = new AssignStatement(new IdentifierExpression("x"), new IntValueExpression(2));

        $stmt = new SequenceStatement($stmt1, $stmt2);

        $stmt->eval($env);

        $this->assertEquals($env->find("x"), 2);
    }
}
