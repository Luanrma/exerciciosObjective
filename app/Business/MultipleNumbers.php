<?php

namespace App\Business;

class MultipleNumbers {

    private $multiplesAdded = [];

    public function multiplesThreeOrFive(int $number): int
    {   
        $this->multiplesAdded = [];

        for ($i=1; $i < $number; $i++) {
            if (($i % 3) == 0 || ($i % 5) == 0) {
                array_push($this->multiplesAdded, $i);
            }		
        }

        return array_sum($this->multiplesAdded);
    }

    public function multiplesThreeAndFive(int $number): int
    {	
        $this->multiplesAdded = [];

        for ($i=1; $i < $number; $i++) {
            if (($i % 3) == 0 && ($i % 5) == 0) {
                array_push($this->multiplesAdded, $i);
            }		
        }

        return array_sum($this->multiplesAdded);
    }

    public function multiplesThreeOrFiveAndSeven(int $number): int
    {
        $this->multiplesAdded = [];
        
        for ($i=1; $i < $number; $i++) {
            if ((($i % 3) == 0 || ($i % 5) == 0) && ($i % 7) == 0) {
                array_push($this->multiplesAdded, $i);
            }		
        }

        return array_sum($this->multiplesAdded);
    }
}