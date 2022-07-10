
<?php

require '../vendor/autoload.php';

use App\Business\HappyNumbers;
use App\Business\MultipleNumbers;
use App\Business\TransformWordsInNumbers;
use App\Services\Correios;
use App\Services\CorreioService;
use App\Services\CorreiosService;
use App\Services\Frete;

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
// $b = new TransformWordsInNumbers(new HappyNumbers, new MultipleNumbers);
// print_r($b->transformWord("CaRrO"));

// $correio = new CorreioService();
// $correio->teste();

$correioObj = new CorreiosService();

$codigoServico = CorreiosService::SERVICO_SEDEX;
$cepOrigem = "09010100";
$cepDestino = "24310430";
$peso = 1;
$formato = CorreiosService::FORMATO_CAIXA_PACOTE;
$comprimento = 15;
$altura = 15;
$largura = 15;
$diametro = 0;
$maoPropria = false;
$valorDeclarado = 0;
$avisoRecebimento = false;

$frete = $correioObj->calcularFrete(
   $codigoServico,
   $cepOrigem,
   $cepDestino,
   $peso,
   $formato,
   $comprimento,
   $altura,
   $largura,
   $diametro,
   $maoPropria,
   $valorDeclarado,
   $avisoRecebimento
);

if (!$frete) {

}

if (strlen($frete->MsgErro)) {
   echo "Erro: " . $frete->MsgErro;
   exit;
}

echo "CEP Origem: " . $cepOrigem . "<br/>";
echo "CEP Destino: " . $cepDestino . "<br/>";
echo "Valor: " . $frete->Valor . "<br/>";
echo "Prazo: " . $frete->PrazoEntrega . "<br/>";


