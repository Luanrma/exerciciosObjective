<?php

namespace App\Tests\Business;

use App\Business\HappyNumbers;
use App\Business\MultipleNumbers;
use App\Business\TransformWordsInNumbers;
use PHPUnit\Framework\TestCase;

class TransformWordsInNumbersTest extends TestCase
{
    private $transformWord;

    public function setUp(): void
    {
        $this->transformWord = new TransformWordsInNumbers(new HappyNumbers, new MultipleNumbers);
    }

    public function testEmptyWord()
    {
        $result = $this->transformWord->transformWord("");
        
        $expectedResult = [
            "wordToNumber" => "0",
            "primeNumber" => "1",
            "happyNumber" => "0",
            "multiplesThreeOrFive" => "0"
        ];

        $this->assertEquals($expectedResult, $result);
    }

    public function testWordWithInvalidCharacters()
    {
        $result = $this->transformWord->transformWord("car345r0o");

        $expectedResult = [
            "wordToNumber" => "55",
            "primeNumber" => "0",
            "happyNumber" => "0",
            "multiplesThreeOrFive" => "698"
        ];

        $this->assertEquals($expectedResult, $result);
    }

    public function testWordWithLowercaseLettersOnly()
    {
        $result = $this->transformWord->transformWord("carro");

        $expectedResult = [
            "wordToNumber" => "55",
            "primeNumber" => "0",
            "happyNumber" => "0",
            "multiplesThreeOrFive" => "698"
        ];

        $this->assertEquals($expectedResult, $result);
    }

    public function testWordWithUpperCaseLettersOnly()
    {
        $result = $this->transformWord->transformWord("CARRO");

        $expectedResult = [
            "wordToNumber" => "185",
            "primeNumber" => "0",
            "happyNumber" => "0",
            "multiplesThreeOrFive" => "7833"
        ];

        $this->assertEquals($expectedResult, $result);
    }

    public function testWordWithUpperAndLowerCaseLetters()
    {
        $result = $this->transformWord->transformWord("CaRrO");

        $expectedResult = [
            "wordToNumber" => "133",
            "primeNumber" => "0",
            "happyNumber" => "1",
            "multiplesThreeOrFive" => "4185"
        ];

        $this->assertEquals($expectedResult, $result);
    }

    public function testPrimeNumberTrue()
    {
        $result = $this->transformWord->primeNumber(11);
        $this->assertTrue($result);
    }

    public function testPrimeNumberFalse()
    {
        $result = $this->transformWord->primeNumber(10);
        $this->assertFalse($result);
    }

    public function testHappyNumberTrue()
    {
        $result = $this->transformWord->happyNumber(7);
        $this->assertTrue($result);
    }

    public function testHappyNumberFalse()
    {
        $result = $this->transformWord->happyNumber(8);
        $this->assertFalse($result);
    }

    public function testMultiplesThreeOrFive()
    {
        $result = $this->transformWord->sumMultiplesThreeOrFive(1000);

        $this->assertEquals(233168, $result);
    }
}