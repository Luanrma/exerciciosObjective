<?php

namespace App\Models;

class User
{
    private string $name;
    private string $zipCode;

    public function __construct(string $name, string $zipCode)
    {
        $this->name = $name;
        $this->zipCode = $zipCode;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }
}