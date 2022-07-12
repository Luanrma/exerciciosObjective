<?php

require '../vendor/autoload.php';

use App\Business\ShoppingCartBusiness;
use App\Models\Product;
use App\Models\User;
use App\Services\CorreiosService;
use App\Services\PaymentService;

echo "<pre>";
// Criando Usuário
$dagoberto = new User("Dagoberto", "82630280");

// Criando Produtos
$cookie = (new Product("Trakinas", 2.50))->getProduct();
$soda = (new Product("Coke 2L", 8.99))->getProduct();
$beer = (new Product("Guiness", 27.90))->getProduct();

$cookie["amount"] = 5;
$soda["amount"] = 2;
$beer["amount"] = 3;

// Vinculando Usuário ao carrinho e inserindo os produtos criados
$shoppingCartBusiness = new ShoppingCartBusiness($dagoberto);
$shoppingCartBusiness->addProductToList($cookie);
$shoppingCartBusiness->addProductToList($soda);
$shoppingCartBusiness->addProductToList($beer);

// Servico de pagamento
$correio = new CorreiosService($dagoberto->getZipCode());
$payment = new PaymentService($shoppingCartBusiness, $correio);
print_r($payment->calculatePayment());