<?php

require '../vendor/autoload.php';

use App\Business\ShoppingCart;
use App\Models\Product;
use App\Models\User;
use App\Services\CorreiosService;

$jose = new User("José", "69980970");

$videoGame = new Product("PS5", 4599.90);
$control = new Product("Control", 349.00);

$listJose = new ShoppingCart($jose, new CorreiosService());
$listJose->addProduct($videoGame->getProduct(), 1);
$listJose->addProduct($control->getProduct(), 2);

$packageParamsJose = [
   'codigoServico' => CorreiosService::SERVICO_SEDEX,
   'cepOrigem' => "09010100",
   'peso' => 1,
   'formato' => CorreiosService::FORMATO_CAIXA_PACOTE,
   'comprimento' => 15,
   'altura' => 15,
   'largura' => 15,
   'diametro' => 0,
   'maoPropria' => false,
   'valorDeclarado' => 0,
   'avisoRecebimento' => false
];

echo "<pre>";
print_r($listJose->calculateShipping($packageParamsJose));
echo "<br/>";

// ----------------------------------------------------------//
$maria = new User("Maria", "29230900");

$cookie = new Product("Trakinas", 2.50);
$soda = new Product("Pepsi 2l", 7.34);

$listMaria = new ShoppingCart($maria, new CorreiosService());
$listMaria->addProduct($cookie->getProduct(), 5);
$listMaria->addProduct($soda->getProduct(), 1);

$packageParamsMaria = [
   'codigoServico' => CorreiosService::SERVICO_PAC,
   'cepOrigem' => "09010100",
   'peso' => 1,
   'formato' => CorreiosService::FORMATO_CAIXA_PACOTE,
   'comprimento' => 10,
   'altura' => 10,
   'largura' => 10,
   'diametro' => 0,
   'maoPropria' => false,
   'valorDeclarado' => 0,
   'avisoRecebimento' => false
];

print_r($listMaria->calculateShipping($packageParamsMaria));
echo "<br/>";