<?php

namespace App\Business;

class TransformWordsInNumbers
{
    const LETTERS_TO_NUMBER = [
        "a" => 1,
        "b" => 2,
        "c" => 3,
        "d" => 4,
        "e" => 5,
        "f" => 6,
        "g" => 7,
        "h" => 8,
        "i" => 9,
        "j" => 10,
        "k" => 11,
        "l" => 12,
        "m" => 13,
        "n" => 14,
        "o" => 15,
        "p" => 16,
        "q" => 17,
        "r" => 18,
        "s" => 19,
        "t" => 20,
        "u" => 21,
        "v" => 22,
        "w" => 23,
        "x" => 24,
        "y" => 25,
        "z" => 26
    ];

    private $happyNumbers;
    private $multipleNumbers;

    public function __construct(
        HappyNumbers $happyNumbers,
        MultipleNumbers $multipleNumbers
    )
    {
        $this->happyNumbers = $happyNumbers;
        $this->multipleNumbers = $multipleNumbers;
    }

    public function transformWord(string $word): array
    {     
        $result = 0;
        
        foreach(str_split($word) as $letter) {
            if ($this->letterExists($letter)) {
                $result += $this->sumValues($letter);
            }
        }
        
        return [
            "wordToNumber" => $result,
            "primeNumber" => (int) $this->primeNumber($result),
            "happyNumber" => (int) $this->happyNumber($result),
            "multiplesThreeOrFive" => $this->sumMultiplesThreeOrFive($result)
        ];
    }

    public function primeNumber(int $number): bool
    {
        for($i = 2; $i < $number; $i++) {
            if ($number % $i == 0) {
                return false;
            }
        }

        return true;
    }

    public function happyNumber(int $number): bool
    {
        return $this->happyNumbers->itsAHappyValue($number);
    }

    public function sumMultiplesThreeOrFive(int $number): int
    {
        return $this->multipleNumbers->multiplesThreeOrFive($number);
    }

    private function sumValues(string $letter): int
    {
        return $this->checkUppercase($letter) ? self::LETTERS_TO_NUMBER[strtolower($letter)] + 26 : self::LETTERS_TO_NUMBER[$letter];
    }
    
    private function checkUppercase(string $letter): bool
    {
        return ctype_upper($letter);
    }
    
    private function letterExists(string $letter): bool
    {
        return array_key_exists(strtolower($letter), self::LETTERS_TO_NUMBER);
    }
}