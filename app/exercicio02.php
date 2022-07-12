<?php

require '../vendor/autoload.php';

use App\Business\HappyNumbers;

$happyNumber = new HappyNumbers();
echo "O 7, é um número feliz ? ";
print_r($happyNumber->itsAHappyValue(7) ? "Sim" : "Não");
echo "<br/>";

echo "O 8, é um número feliz ? ";
print_r($happyNumber->itsAHappyValue(8) ? "Sim" : "Não");