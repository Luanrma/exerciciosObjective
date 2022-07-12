<?php

namespace App\Services;

class CorreiosService
{
    CONST GRANDE_SAO_PAULO = '0';
    CONST PARANA_SANTA_CATARINA = '8';

    private $zipCode;    

    public function __construct(string $zipCode)
    {
        $this->zipCode = $zipCode;
    }

    public function calculateShipping(): float
    {
        $shippingPrice = 50;

        $firstDigitzipCode = $this->zipCode[0];

        if ($firstDigitzipCode == self::PARANA_SANTA_CATARINA || $firstDigitzipCode == self::GRANDE_SAO_PAULO) {
            $shippingPrice = 25.00;
        }

        return $shippingPrice;
    }
}