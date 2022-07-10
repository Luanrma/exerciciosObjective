<?php

namespace App\Tests\Business;

use App\Business\MathChallenge;
use PHPUnit\Framework\TestCase;

class MathChallengeTest extends TestCase
{
    public function testMultiplesThreeOrFiveMinorThousand()
    {
        $multiples = new MathChallenge();

        $result = $multiples->multiplesThreeOrFiveMinorThousand();

        $this->assertEquals(233168, $result);
    }

    public function testMultiplesThreeAndFiveMinorThousand()
    {
        $multiples = new MathChallenge();

        $result = $multiples->multiplesThreeAndFiveMinorThousand();

        $this->assertEquals(33165, $result);
    }

    public function testMultiplesThreeOrFiveAndSevenMinorThousand()
    {
        $multiples = new MathChallenge();

        $result = $multiples->multiplesThreeOrFiveAndSevenMinorThousand();

        $this->assertEquals(33173, $result);
    }

    public function testThisIsAhappyNumbers()
    {
        $multiples = new MathChallenge();

        $result = $multiples->happyNumbers(49);

        $this->assertEquals(true, $result);
    }

    public function testThisIsNotAhappyNumbers()
    {
        $multiples = new MathChallenge();

        $result = $multiples->happyNumbers(50);

        $this->assertEquals(false, $result);
    }
}