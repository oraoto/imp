<?php

namespace Oraoto\Imp;

class Token
{

    const TOKEN_INT = 1;
    const TOKEN_ID = 3;
    const TOKEN_IF = 4;
    const TOKEN_THEN = 5;
    const TOKEN_ELSE = 6;
    const TOKEN_SEMICOLON = 7;
    const TOKEN_ASSIGN = 8;
    const TOKEN_ADD = 9;
    const TOKEN_DIV = 10;
    const TOKEN_LE  = 11;
    const TOKEN_NOT = 12;
    const TOKEN_AND = 13;
    const TOKEN_WHILE = 14;
    const TOKEN_DO = 15;
    const TOKEN_SKIP = 16;
    const TOKEN_TRUE = 17;
    const TOKEN_FALSE = 18;
    const TOKEN_EOF = 99;

    public $token_type;
    public $content;

    public function __construct($t, $content = '')
    {
        $this->token_type = $t;
        $this->content = $content;
    }
}
