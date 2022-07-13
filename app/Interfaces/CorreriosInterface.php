<?php

namespace App\Interfaces;

Interface CorreriosInterface
{
    public function calculateShipping(string $zipCode): float;
}