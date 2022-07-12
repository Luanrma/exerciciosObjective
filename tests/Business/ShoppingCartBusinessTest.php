<?php

namespace App\Tests\Business;

use App\Business\ShoppingCartBusiness;
use App\Models\Product;
use App\Models\User;
use PHPUnit\Framework\TestCase;

class ShoppingCartBusinessTest extends TestCase
{
    private $shoppingCartBusiness;

    protected function setUp(): void
    {
        $user = new User("Dagoberto", "82630280");
        $this->shoppingCartBusiness = new ShoppingCartBusiness($user);
    }

    /**
     * @dataProvider createThreeProducts
     */
    public function testIfAddProductToList($cookie, $soda, $beer)
    {
        foreach([$cookie, $soda, $beer] as $product) {
            $this->shoppingCartBusiness->addProductToList($product);
        };

        $productsList = $this->shoppingCartBusiness->getShoppingList();

        static::assertCount(3, $productsList);
        static::assertEquals($cookie, $productsList[0]);
        static::assertEquals($soda, $productsList[1]);
        static::assertEquals($beer, $productsList[2]);
    }

    /**
     * @dataProvider createThreeProducts
     */
    public function testIfRemoveProductToList($cookie, $soda, $beer)
    {
        foreach([$cookie, $soda, $beer] as $product) {
            $this->shoppingCartBusiness->addProductToList($product);
        };

        $productsList = $this->shoppingCartBusiness->getShoppingList();
        static::assertCount(3, $productsList);

        $this->shoppingCartBusiness->removeProductFromCart($soda['name']);
        $productsList = $this->shoppingCartBusiness->getShoppingList();
        static::assertCount(2, $productsList);

        static::assertEquals($cookie, $productsList[0]);
        static::assertEquals($beer, $productsList[1]);
    }

    /**
     * @dataProvider createThreeProducts
     */
    public function testIfNotInformedValidQuantityToProduct($cookie, $soda, $beer)
    {
        $cookie['amount'] = 0;

        foreach([$cookie, $soda, $beer] as $product) {
            $this->shoppingCartBusiness->addProductToList($product);
        };
 
        $productsList = $this->shoppingCartBusiness->getShoppingList();
        
        static::assertCount(2, $productsList);
        static::assertEquals($soda, $productsList[0]);
        static::assertEquals($beer, $productsList[1]);
    }

    /**
     * @dataProvider createTwoIdenticalProducts
     */
    public function testIfTryAddTwoIdenticalProductsToList($cookie1, $cookie2)
    {
        foreach([$cookie1, $cookie2] as $product) {
            $this->shoppingCartBusiness->addProductToList($product);
        };

        $productsList = $this->shoppingCartBusiness->getShoppingList();   
        static::assertCount(1, $productsList);
    }

    /**
     * @dataProvider createThreeProducts
     */
    public function testCalculateTotalShoppingValueAfterAddingProducts($cookie, $soda, $beer)
    {
        foreach([$cookie, $soda, $beer] as $product) {
            $this->shoppingCartBusiness->addProductToList($product);
        };
 
        $totalShoppingCartValue = $this->shoppingCartBusiness->getShoppingCartValue();
        static::assertEquals($totalShoppingCartValue, 114.18);
    }

    /**
     * @dataProvider createThreeProducts
     */
    public function testCalculateTotalShoppingValueAfterRemoveProduct($cookie, $soda, $beer)
    {
        foreach([$cookie, $soda, $beer] as $product) {
            $this->shoppingCartBusiness->addProductToList($product);
        };

        $this->shoppingCartBusiness->removeProductFromCart($soda['name']);
 
        $totalShoppingCartValue = $this->shoppingCartBusiness->getShoppingCartValue();
        static::assertEquals($totalShoppingCartValue, 96.20);
    }

    public function testCalculateTotalShoppingValueWithoutAddingProducts()
    {
        $totalShoppingCartValue = $this->shoppingCartBusiness->getShoppingCartValue();
        static::assertEquals($totalShoppingCartValue, 0);
    }

    public function createThreeProducts()
    {
        $cookie = (new Product("Trakinas", 2.50))->getProduct();
        $soda = (new Product("Coke 2L", 8.99))->getProduct();
        $beer = (new Product("Guiness", 27.90))->getProduct();

        $cookie["amount"] = 5;
        $soda["amount"] = 2;
        $beer["amount"] = 3;

        return [
            [$cookie, $soda, $beer]
        ];
    }

    public function createTwoIdenticalProducts()
    {
        $cookie = (new Product("Trakinas", 2.50))->getProduct();
        $cookie["amount"] = 5;

        return [
            [$cookie, $cookie]
        ];
    }
}