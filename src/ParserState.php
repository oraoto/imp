<?php
namespace Oraoto\Imp;

class ParserState
{
    private $tokens;

    public function __construct($tokens)
    {
        $this->tokens = $tokens;
    }

    public function advanceToken()
    {
        $this->tokens = array_slice($this->tokens, 1);
    }

    public function currentToken()
    {
        return $this->tokens[0];
    }
}
