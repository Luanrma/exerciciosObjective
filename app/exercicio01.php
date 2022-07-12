<?php

require '../vendor/autoload.php';

use App\Business\MultipleNumbers;

echo "<pre>";

$multipleNumbers = new MultipleNumbers();

echo "Múltiplos de 3 ou 5 menores que 1000: ";
echo "<strong>";
print_r($multipleNumbers->multiplesThreeOrFive(1000));
echo "</strong>";

echo "<br/>";

echo "Múltiplos de 3 e 5 menores que 1000: ";
echo "<strong>";
print_r($multipleNumbers->multiplesThreeAndFive(1000));
echo "</strong>";

echo "<br/>";

echo "Múltiplos de (3 ou 5) e 7 menores que 1000: ";
echo "<strong>";
print_r($multipleNumbers->multiplesThreeOrFiveAndSeven(1000));
echo "</strong>";