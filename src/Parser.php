<?php
namespace Oraoto\Imp;

use Oraoto\Imp\Exception\ParserException;

class Parser
{
    private $state;

    public function parse($tokens)
    {
        $this->state = new ParserState($tokens);
        $statement = $this->parseStatement();
        $tk = $this->state->currentToken();
        if ($tk->token_type !== Token::TOKEN_EOF) {
            throw new ParserException('expect eof token');
        }
        return $statement;
    }

    private function parseStatement()
    {
        $tk = $this->state->currentToken();
        $stmt = null;
        switch ($tk->token_type) {
            case Token::TOKEN_SKIP:
                $stmt = $this->parseSkipStatement();
                break;
            case Token::TOKEN_ID:
                $stmt = $this->parseAssignStatement();
                break;
        }

        $tk = $this->state->currentToken();
        if ($tk->token_type == Token::TOKEN_SEMICOLON) {
            return $this->parseSequenceStatement($stmt);
        } else {
            return $stmt;
        }
    }

    private function parseSkipStatement()
    {
        $this->state->advanceToken();
        return new Statement\SkipStatement();
    }

    private function parseSequenceStatement($left)
    {
        $this->state->advanceToken();
        $right = $this->parseStatement();
        return new Statement\SequenceStatement($left, $right);
    }

    private function parseAssignStatement()
    {
        $tk = $this->state->currentToken();
        $name = $tk->content;
        $id = new Expression\IdentifierExpression($name);

        $this->state->advanceToken();
        $assignToken = $this->state->currentToken();
        if ($assignToken->token_type !== Token::TOKEN_ASSIGN) {
            throw new ParserException('expect :=');
        }

        $this->state->advanceToken();
        $expr = $this->parseArithmeticExpression();
        return new Statement\AssignStatement($id, $expr);
    }

    private function parseArithmeticExpression()
    {
        $tk = $this->state->currentToken();
        $expr = null;
        switch ($tk->token_type) {
            case Token::TOKEN_ID:
                $expr = new Expression\IdentifierExpression($tk->content);
                $this->state->advanceToken();
                break;
            case Token::TOKEN_INT:
                $expr = new Expression\IntValueExpression($tk->content);
                $this->state->advanceToken();
                break;
            default:
                $expr = $this->parseArithmeticExpression();
        }

        $tk = $this->state->currentToken();
        if ($tk->token_type === Token::TOKEN_ADD) {
            return $this->parseAddExpression($expr);
        } elseif ($tk->token_type === Token::TOKEN_DIV) {
            return $this->parseDivExpression($expr);
        }
        return $expr;
    }

    private function parseAddExpression($left)
    {
        $this->state->advanceToken();
        $right = $this->parseArithmeticExpression();
        return new Expression\AddExpression($left, $right);
    }

    private function parseDivExpression($left)
    {
        $this->state->advanceToken();
        $right = $this->parseArithmeticExpression();
        return new Expression\DivExpression($left, $right);
    }
}
