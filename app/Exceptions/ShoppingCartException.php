<?php

namespace App\Exceptions;

use Exception;

class ShoppingCartException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}