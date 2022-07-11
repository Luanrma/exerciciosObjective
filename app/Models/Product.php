<?php

namespace App\Models;

class Product
{
    private $name;
    private $value;

    public function __construct(string $name, float $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getProduct()
    {
        return [
            'name' => $this->name,
            'value' => $this->value
        ];
    }
}