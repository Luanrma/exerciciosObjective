<?php

require '../vendor/autoload.php';

use App\Business\ShoppingCart;
use App\Models\Product;
use App\Models\User;
use App\Services\CorreiosService;

$jose = new User("José", "69980970");

$videoGame = new Product("PS5", 4599.90);
$control = new Product("Control", 349.00);

$list = new ShoppingCart($jose, new CorreiosService());
$list->addProduct($videoGame, 1);
$list->addProduct($control, 2);

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

print_r($list->calculateShipping($packageParamsJose));
echo "<br/>";

// ----------------------------------------------------------//
$maria = new User("Maria", "29230900");

$cookie = new Product("Trakinas", 2.50);
$soda = new Product("Pepsi 2l", 7.34);

$list = new ShoppingCart($maria, new CorreiosService());
$list->addProduct($cookie, 5);
$list->addProduct($soda, 1);

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

print_r($list->calculateShipping($packageParamsMaria));
echo "<br/>";