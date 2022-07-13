<?php

namespace App\Services;

use App\Interfaces\CorreriosInterface;

class CorreiosService implements CorreriosInterface
{
    CONST GRANDE_SAO_PAULO = '0';
    CONST PARANA_SANTA_CATARINA = '8';

    public function calculateShipping(string $zipCode): float
    {
        $shippingPrice = 50;

        $firstDigitzipCode = $zipCode[0];

        if ($firstDigitzipCode == self::PARANA_SANTA_CATARINA || $firstDigitzipCode == self::GRANDE_SAO_PAULO) {
            $shippingPrice = 25.00;
        }

        return $shippingPrice;
    }
}