<?php

namespace App\Exceptions;

use Exception;

class HappyNumbersException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}