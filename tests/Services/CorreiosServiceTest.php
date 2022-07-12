<?php

namespace App\Tests\Services;

use App\Services\CorreiosService;
use PHPUnit\Framework\TestCase;

class CorreiosServiceTest extends TestCase
{
    /**
     * @dataProvider provideZipCode
     */
    public function testCalculateShipping($zipCode)
    {
        $correiosService = new CorreiosService($zipCode[0]);
        $result = $correiosService->calculateShipping();
        static::assertEquals($zipCode[1], $result);
    }

    public function provideZipCode()
    {
        return [
            [['82630280', 25.00]],
            [['57600716', 50.00]],
            [['12413070', 50.00]],
            [['08574455', 25.00]]
        ];
    }

}