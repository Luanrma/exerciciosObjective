<?php

namespace App\Tests\Business;

use App\Business\MultipleNumbers;
use PHPUnit\Framework\TestCase;

class MultipleNumbersTest extends TestCase
{
    private $multiples;

    public function setUp(): void
    {
        $this->multiples = new MultipleNumbers();
    }

    public function testMultiplesThreeOrFiveMinorThousand()
    {
        $result = $this->multiples->multiplesThreeOrFive(1000);

        $this->assertEquals(233168, $result);
    }

    public function testMultiplesThreeAndFiveMinorThousand()
    {
        $result = $this->multiples->multiplesThreeAndFive(1000);

        $this->assertEquals(33165, $result);
    }

    public function testMultiplesThreeOrFiveAndSevenMinorThousand()
    {
        $result = $this->multiples->multiplesThreeOrFiveAndSeven(1000);

        $this->assertEquals(33173, $result);
    }
}