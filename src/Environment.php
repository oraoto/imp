<?php
namespace Oraoto\Imp;

class Environment
{
    private $env;

    public function __construct($default = [])
    {
        $this->env = $default;
    }

    public function add($key, $value)
    {
        $this->env[$key] = $value;
    }

    public function find($key)
    {
        if (isset($this->env[$key])) {
            return $this->env[$key];
        } else {
            throw new Exception\EnvironmentException();
        }
    }
}
