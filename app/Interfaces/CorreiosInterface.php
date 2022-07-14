<?php

namespace App\Interfaces;

Interface CorreiosInterface
{
    public function calculateShipping(string $zipCode): float;
}