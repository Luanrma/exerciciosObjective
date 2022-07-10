<?php

namespace App\Tests\Business;

use App\Business\HappyNumbers;
use App\Exceptions\HappyNumbersException;
use PHPUnit\Framework\TestCase;

class HappyNumbersTest extends TestCase
{
    private $happyNumber;

    public function setUp(): void
    {
        $this->happyNumber = new HappyNumbers();
    }

    public function testHappyNumbersTrue()
    {
        $result = $this->happyNumber->itsAHappyValue(49);

        $this->assertEquals(true, $result);
    }

    public function testHappyNumbersFalse()
    {
        $result = $this->happyNumber->itsAHappyValue(50);

        $this->assertEquals(false, $result);
    }

    public function testHappyNumbersReceivedInvalidValue()
    {
        $this->expectException(HappyNumbersException::class);
        $this->expectExceptionMessage('Invalid value!');

        $this->happyNumber->itsAHappyValue(-50);
    }
}