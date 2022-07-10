
<?php

require '../vendor/autoload.php';

use App\Business\HappyNumbers;
use App\Business\MathChallenge;

try {
   $a = new HappyNumbers();
   var_dump($a->itsAHappyValue(-50));
} catch (Exception $e) {
   echo $e->getMessage();
}