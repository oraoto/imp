<?php
namespace Oraoto\Imp;

use Oraoto\Imp\Exception\TokenizerException;

class Tokenizer
{

    private $keywords = [
        'if' => Token::TOKEN_IF,
        'then' => Token::TOKEN_THEN,
        'else' => Token::TOKEN_ELSE,
        'while' => Token::TOKEN_WHILE,
        'do' => Token::TOKEN_DO,
        'skip' => Token::TOKEN_SKIP,
        ':=' => Token::TOKEN_ASSIGN,
        'and' => Token::TOKEN_AND,
        'not' => Token::TOKEN_NOT,
        '<=' => Token::TOKEN_LE,
        'true' => Token::TOKEN_TRUE,
        'false' => Token::TOKEN_FALSE
    ];

    public function tokenize(string $input)
    {
        $tokens = [];
        $length = strlen($input);

        $acc = '';

        for ($i = 0; $i < $length; $i++) {
            $c = $input[$i];

            if ($this->isWhiteSpace($c)) {
                continue;
                // if ($acc != '') {
                //     if (isset($this->keywords[$acc])) {
                //         $tokens[] = new Token($this->keywords[$acc], $acc);
                //     } elseif ($this->isAlphabet($acc)) {
                //         $tokens[] = new Token(Token::TOKEN_ID, $acc);
                //     } elseif ($this->isNumeric($acc)) {
                //         $tokens[] = new Token(TOken::TOKEN_INT, $acc);
                //     }
                // }
            }

            if ($c == '+') {
                $tokens[] = new Token(Token::TOKEN_ADD, $c);
                continue;
            }
            if ($c == '/') {
                $tokens[] = new Token(Token::TOKEN_DIV, $c);
                continue;
            }
            if ($c == ';') {
                $tokens[] = new Token(Token::TOKEN_SEMICOLON, $c);
                continue;
            }
            if ($c == ':') {
                if ($i + 1 < $length && $input[$i + 1] == '=') {
                    $tokens[] = new Token(Token::TOKEN_ASSIGN, ":=");
                    $i++;
                    continue;
                } else {
                    throw new TokenizerException('expect = after :');
                }
            }
            if ($c == '>') {
                if ($i + 1 < $length && $input[$i + 1] == '=') {
                    $tokens[] = new Token(Token::TOKEN_LE, ">=");
                    $i++;
                    continue;
                } else {
                    throw new TokenizerException('expect = after >');
                }
            }


            if ($this->isNumeric($c)) {
                $acc .= $c;
                for ($j = $i + 1; $j < $length; $j++) {
                    if ($this->isNumeric($input[$j])) {
                        $acc .= $input[$j];
                    } else {
                        break;
                    }
                }
                $this->expect(
                    'non-alphabet after int',
                    $j == $length || !$this->isAlphabet($input[$j])
                );
                $tokens[] = new Token(Token::TOKEN_INT, (int)$acc);
                $acc = '';
                $i = $j - 1;
                continue;
            }

            if ($this->isAlphabet($c)) {
                $acc .= $c;
                for ($j = $i + 1; $j < $length; $j++) {
                    if ($this->isAlphabet($input[$j])) {
                        $acc .= $input[$j];
                    } else {
                        break;
                    }
                }
                $this->expect(
                    'non-alphabet after alphabet',
                    $j == $length || !$this->isAlphabet($input[$j])
                );
                if (isset($this->keywords[$acc])) {
                    $tokens[] = new Token($this->keywords[$acc], $acc);
                } else {
                    $tokens[] = new Token(Token::TOKEN_ID, $acc);
                }
                $acc = '';
                $i = $j - 1;
                continue;
            }
            throw new TokenizerException('Unknown token: ' . $c);
        }
        $tokens[] = new Token(Token::TOKEN_EOF);
        return $tokens;
    }

    private function isWhiteSpace($c)
    {
        $w = ['\n', '\t', '\r', ' '];
        return \array_search($c, $w) !== false;
    }

    private function isAlphabet($c)
    {
        return preg_match("/[A-Za-z]+/", $c) === 1;
    }

    private function isNumeric($c)
    {
        return preg_match("/[0-9]+/", $c) === 1;
    }

    private function expect($desc, $succ)
    {
        if (!$succ) {
            throw new TokenizerException($desc . ': ' . $input[$index]);
        }
    }
}
