<?php

namespace App\Business;

use App\Exceptions\HappyNumbersException;

class HappyNumbers
{
    private $valuesAdded = [];
    private $initialValue = 0;

    public function itsAHappyValue(int $value)
    {
        $this->checkValue($value);
        
        $currentValue = $this->initialValue;
        
        while($currentValue != 1) {
            $result = $this->calculateHappyNumber($currentValue);
            
            if ($this->resultAlreadyCalculated($result)) {
                return false;
            }

            array_push($this->valuesAdded, $result);
           
            $currentValue = $result;
        }

        return true;
    }

    public function getInitialValue(): int
    {
        return $this->initialValue;
    }

    public function getValuesAdded(): array
    {
        return $this->valuesAdded;
    }

    private function calculateHappyNumber(int $currentValue)
    {
        $result = 0;

        foreach(str_split($currentValue) as $value) {
            $result += $value ** 2;
        }

        return $result;
    }

    private function resultAlreadyCalculated(int $result)
    {
        if (in_array($result, $this->valuesAdded)) {
            return true;
        }
    }

    private function checkValue(int $value)
    {
        if ($value < 0) {
            throw new HappyNumbersException("Invalid value!");
        }

        $this->initialValue = $value;
    }
}