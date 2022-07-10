
<?php

require '../vendor/autoload.php';

use App\Business\HappyNumbers;
use App\Business\MultipleNumbers;
use App\Business\TransformWordsInNumbers;

// $c = new MultipleNumbers;
// echo $c->multiplesThreeOrFiveMinor(10);
// try {
//    $a = new HappyNumbers();
//    var_dump($a->itsAHappyValue(50));
//    echo "<br/>Valor inicial é: " . $a->getInitialValue();
//    foreach($a->getValuesAdded() as $value) {
//       echo "<br/> Os valores calculados são: $value <br/>";
//    }

// } catch (Exception $e) {
//    echo $e->getMessage();
// }
echo "<pre>";
$b = new TransformWordsInNumbers(new HappyNumbers, new MultipleNumbers);
print_r($b->transformWord("CaRrO"));