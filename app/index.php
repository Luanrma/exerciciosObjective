
<?php

require '../vendor/autoload.php';

use App\Business\MathChallenge;

try {
   $a = new MathChallenge();
   var_dump($a->multiplesThreeOrFiveAndSevenMinorThousand());
} catch (Exception $e) {
   echo $e->getMessage();
}