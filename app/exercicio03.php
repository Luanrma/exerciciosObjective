<?php

require '../vendor/autoload.php';

use App\Business\HappyNumbers;
use App\Business\MultipleNumbers;
use App\Business\TransformWordsInNumbers;

$transformWord = new TransformWordsInNumbers(new HappyNumbers, new MultipleNumbers);

echo "<pre>";
print_r($transformWord->transformWord("l0oUCuR@a"));
print_r($transformWord->transformWord("loUCuRa"));
print_r($transformWord->transformWord("loucura"));
print_r($transformWord->transformWord("LOUCURA"));