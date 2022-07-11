<?php

namespace App\Business;

use App\Models\Product;
use App\Models\User;
use App\Services\CorreiosService;

class ShoppingCart
{
    private $shoppingList = [];
    private $listOwner;
    private $correios;

    public function __construct(
        User $listOwner,
        CorreiosService $correios
    )
    {
        $this->listOwner = $listOwner;
        $this->correios = $correios;
    }

    public function addProduct(Product $product, int $amount): void
    {
        array_push($this->shoppingList, [
            "name" => $product->getName(),
            "value" => $product->getValue(),
            "amount" => $amount
        ]);
    }

    public function calculateShipping(array $packageParams)
    {
        $totalShoppingCart = $this->calculateShoppingCart();
        $shippingValue = 0;

        if ($totalShoppingCart > 100) {
            $params = array_merge(['cepDestino' => $this->listOwner->getCep()], $packageParams);
            $shippingValue = (float) $this->correios->calculateShipping($params)[0]->Valor;
        }

        return [
            "ClientData" => $this->getShoppingList(),
            "TotalProductsPrice" => $totalShoppingCart,
            "Shipping" => $shippingValue,
            "TotalPriceWithShipping" => $totalShoppingCart + $shippingValue,
        ];
    }  
    
    public function calculateShoppingCart()
    {
        $totalProductsValue = 0;

        foreach($this->getShoppingList()['products'] as $product) {
            $totalProductsValue += ($product['value'] * $product['amount']);
        }

        return $totalProductsValue;
    }

    public function getShoppingList()
    {
        return [
            "client" => [
                "name" => $this->listOwner->getName(),
                "cep" => $this->listOwner->getCep()
            ],
            "products" => $this->shoppingList
        ];
    }

}