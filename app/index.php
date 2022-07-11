<?php

require '../vendor/autoload.php';

use App\Business\ShoppingCart;
use App\Models\Product;
use App\Models\User;
use App\Services\CorreiosService;

$maria = new User("Maria", "29230900");

$cookie = new Product("Trakinas", 2.50);
$soda = new Product("Pepsi 2l", 7.34);

$listMaria = new ShoppingCart($maria, new CorreiosService());

$listMaria->addProduct(['name' => 'test1', 'value' => 100.50], 2);

$listMaria->addProduct(['name' => 'test2', 'value' => 11.50], 5);

$listMaria->removeProductFromCart('test1');

echo "<pre>";
print_r($listMaria->getShoppingList());
