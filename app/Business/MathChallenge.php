<?php

namespace App\Business;

use Exception;

class MathChallenge {

    private $multiplesAdded = [];

    public function multiplesThreeOrFiveMinorThousand(): int
    {   
        for ($i=1; $i < 1000; $i++) {
            if (($i % 3) == 0 || ($i % 5) == 0) {
                array_push($this->multiplesAdded, $i);
            }		
        }

        return array_sum($this->multiplesAdded);
    }

    public function multiplesThreeAndFiveMinorThousand(): int
    {	
        for ($i=1; $i < 1000; $i++) {
            if (($i % 3) == 0 && ($i % 5) == 0) {
                array_push($this->multiplesAdded, $i);
            }		
        }

        return array_sum($this->multiplesAdded);
    }

    public function multiplesThreeOrFiveAndSevenMinorThousand(): int
    {
        for ($i=1; $i < 1000; $i++) {
            if ((($i % 3) == 0 || ($i % 5) == 0) && ($i % 7) == 0) {
                array_push($this->multiplesAdded, $i);
            }		
        }

        return array_sum($this->multiplesAdded);
    }

    public function happyNumbers(int $value): bool
    {
        if ($value < 0) {
            throw new Exception("Invalid number!");
        }

        $currentValue = $value;
        $result = 0;
        $calculatedNumbers = [];
        
        while($currentValue != 1) {
            foreach(str_split($currentValue) as $value) {
                $result += $value ** 2;
            }
            
            if (in_array($result, $calculatedNumbers)) {
                return false;
            }
            
            array_push($calculatedNumbers, $result);
            $currentValue = $result;
            $result = 0;
        }

        return true;
    }
}