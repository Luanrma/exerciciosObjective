<?php

namespace App\Business;

use App\Exceptions\ShoppingCartException;
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

    public function addProduct(array $productData, int $amount): void
    {
        if ($this->checkIfProductAlreadyAdded($productData['name'])) {
            throw new ShoppingCartException('This product has already been added to cart!');
        }

        array_push($this->shoppingList, array_merge($productData, ["amount" => $amount]));
    }

    public function removeProductFromCart(string $productName): void
    {
        foreach($this->shoppingList as $key => $value) {
           
            if ($value['name'] == $productName) {
                array_splice($this->shoppingList, $key, 1);            
            }
        }
    }

    private function checkIfProductAlreadyAdded(string $productName) 
    {
        foreach($this->shoppingList as $key => $value) {
            if ($value['name'] == $productName) {
                return true;                
            }
        }

        return false;
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

        foreach($this->getShoppingList() as $product) {
            $totalProductsValue += ($product['value'] * $product['amount']);
        }

        return $totalProductsValue;
    }

    public function getShoppingList()
    {
        return $this->shoppingList;
    }
}