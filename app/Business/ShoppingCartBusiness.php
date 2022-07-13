<?php

namespace App\Business;

use App\Exceptions\ShoppingCartException;
use App\Models\User;

class ShoppingCartBusiness
{
    private object $user;
    private array $shoppingList = [];
    private float $totalShoppingCartValue = 0;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getShoppingList()
    {
        return $this->shoppingList;
    }

    public function getUserData()
    {
        return [
            "name" => $this->user->getName(),
            "zipCode" => $this->user->getZipCode()
        ];
    }

    public function getShoppingCartValue(): float
    {
        return $this->totalShoppingCartValue;
    }

    public function setShoppingCartValue(): void
    {
        if (!empty($this->shoppingList)) {
            $this->totalShoppingCartValue = 0;

            foreach($this->shoppingList as $product) {
                $this->totalShoppingCartValue += ($product['value'] * $product['amount']);
            }
        }
    }

    public function addProductToList(array $product)
    {
        try {
            if (empty($product['amount'])) {
                throw new ShoppingCartException('Not informed a valid quantity for the product ' . $product['name']);
            }

            if (!$this->checkIfProductAlreadyAdded($product['name'])) {
                array_push($this->shoppingList, $product);
                $this->setShoppingCartValue();
            }
        } catch (ShoppingCartException $e) {
            error_log($e->getMessage());
        }
    }
       
    public function removeProductFromCart(string $productName): void
    {
        foreach($this->shoppingList as $key => $product) {
            if ($product['name'] == $productName) {
                array_splice($this->shoppingList, $key, 1);
                $this->setShoppingCartValue();
            }
        }
    }

    private function checkIfProductAlreadyAdded(string $productName) 
    {
        foreach($this->shoppingList as $key => $product) {
            if ($product['name'] == $productName) {
                throw new ShoppingCartException('The ' . $productName . ' product has already been added to cart!');               
            }
        }
        
        return false;
    }
}