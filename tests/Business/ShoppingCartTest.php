<?php

namespace App\Tests\Business;

use App\Business\ShoppingCart;
use App\Exceptions\ShoppingCartException;
use App\Models\User;
use App\Services\CorreiosService;
use PHPUnit\Framework\TestCase;

class ShoppingCartTest extends TestCase
{
    private $correiosServiceMock;
    private $userMock;
    private $shoppingCart;

    public function setUp(): void
    {
        parent::setUp();

        $this->userMock = $this
            ->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();
            
        $this->correiosServiceMock = $this
            ->getMockBuilder(CorreiosService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shoppingCart = new ShoppingCart(
            $this->userMock,
            $this->correiosServiceMock
        );
    }

    public function testWhatIfTheCartIsEmpty()
    {
        $this->shoppingCart = new ShoppingCart($this->userMock, $this->correiosServiceMock);
        $result = $this->shoppingCart->getShoppingList();

        $expectedResult = [];

        $this->assertEquals($expectedResult, $result);
    }

    public function testAddProductInShoppingCart()
    {
        $this->shoppingCart = new ShoppingCart($this->userMock, $this->correiosServiceMock);
        
        $this->shoppingCart->addProduct(['name' => 'test', 'value' => 100.50], 2);
        $result = $this->shoppingCart->getShoppingList();

        $expectedResult = [
            [
                'name' => 'test',
                'value' => 100.50,
                'amount' => 2
            ]
        ];

        $this->assertEquals($expectedResult, $result);
    }

    public function testAddProductThatIsAlreadyInTheCart()
    {
        $this->shoppingCart = new ShoppingCart($this->userMock, $this->correiosServiceMock);

        $this->shoppingCart->addProduct(['name' => 'test', 'value' => 100.50], 2);

        $this->expectException(ShoppingCartException::class);
        $this->expectExceptionMessage('This product has already been added to cart!');

        $this->shoppingCart->addProduct(['name' => 'test', 'value' => 100.50], 2);
    }

    public function testRemoveProductFromCart()
    {
        $this->shoppingCart = new ShoppingCart($this->userMock, $this->correiosServiceMock);

        $this->shoppingCart->addProduct(['name' => 'test1', 'value' => 100.50], 2);
        $this->shoppingCart->addProduct(['name' => 'test2', 'value' => 11.50], 7);

        $this->shoppingCart->removeProductFromCart('test1');

        $result = $this->shoppingCart->getShoppingList();
        
        $expectedResult = [
            [
                'name' => 'test2',
                'value' => 11.50,
                'amount' => 7
            ]
        ];

        $this->assertEquals($expectedResult, $result);
    }
}