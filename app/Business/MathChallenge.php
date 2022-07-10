<?php

namespace App\Business;

use App\Exceptions\HappyNumbersException;
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
}