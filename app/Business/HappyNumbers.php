<?php

namespace App\Business;

use App\Exceptions\HappyNumbersException;

class HappyNumbers
{
    private $valuesAdded = [];
    private $initialValue = 0;
    private $currentValue = 0;
    private $result = 0;

    public function itsAHappyValue(int $value)
    {
        $this->checkValue($value);
        
        $this->currentValue = $this->initialValue;
        $this->result = 0;
        
        while($this->currentValue != 1) {
            $this->calculateHappyNumber();
            
            if ($this->resultAlreadyCalculated($this->result)) {
                return false;
            }

            array_push($this->valuesAdded, $this->result);
           
            $this->currentValue = $this->result;
            $this->result = 0;
        }

        return true;
    }

    public function calculateHappyNumber()
    {
        foreach(str_split($this->currentValue) as $value) {
            $this->result += $value ** 2;
        }
    }

    public function resultAlreadyCalculated(int $result)
    {
        if (in_array($result, $this->valuesAdded)) {
            return true;
        }
    }

    public function checkValue(int $value)
    {
        if ($value < 0) {
            throw new HappyNumbersException("Invalid number!");
        }

        $this->initialValue = $value;
    }
}