<?php

namespace App\Models;

class User
{
    private $name;
    private $cep;

    public function __construct(string $name, string $cep)
    {
        $this->name = $name;
        $this->cep = $cep;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCep()
    {
        return $this->cep;
    }
}