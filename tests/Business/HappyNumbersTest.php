<?php

namespace App\Tests\Business;

use App\Business\HappyNumbers;
use App\Exceptions\HappyNumbersException;
use PHPUnit\Framework\TestCase;

class HappyNumbersTest extends TestCase
{
    public function testHappyNumbersTrue()
    {
        $multiples = new HappyNumbers();

        $result = $multiples->itsAHappyValue(49);

        $this->assertEquals(true, $result);
    }

    public function testHappyNumbersFalse()
    {
        $multiples = new HappyNumbers();

        $result = $multiples->itsAHappyValue(50);

        $this->assertEquals(false, $result);
    }

    public function testHappyNumbersReceivedInvalidValue()
    {
        $multiples = new HappyNumbers();

        $this->expectException(HappyNumbersException::class);
        $this->expectExceptionMessage('Invalid number!');

        $multiples->itsAHappyValue(-50);
    }
}