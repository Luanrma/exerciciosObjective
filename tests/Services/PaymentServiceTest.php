<?php

namespace App\Tests\Services;

use App\Business\ShoppingCartBusiness;
use App\Services\CorreiosService;
use App\Services\PaymentService;
use PHPUnit\Framework\TestCase;

class PaymentServiceTest extends TestCase
{
    private $paymentService;
    private $shoppingCartBusinessMock;
    private $correiosServiceMock;

    public function setUp(): void
    {
        $this->shoppingCartBusinessMock = $this
            ->getMockBuilder(ShoppingCartBusiness::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->correiosServiceMock = $this
            ->getMockBuilder(CorreiosService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentService = new PaymentService($this->shoppingCartBusinessMock, $this->correiosServiceMock);
    }

    /**
     * @dataProvider paymentDetailsWithValueGreaterThanOneHundred
     */
    public function testCalculatePaymentWithValueGreaterThanOneHundred($paymentDetails)
    {
        $this->shoppingCartBusinessMock
            ->method('getUserData')
            ->willReturn([
                'name' => 'Dagoberto',
                'zipCode' => '82630280'
            ]);

        $this->shoppingCartBusinessMock
            ->method('getShoppingList')
            ->willReturn([
                [
                    'name' => 'Trakinas',
                    'value' => 2.5,
                    'amount' => 5
                ],
                [
                    'name' => 'Coke 2L',
                    'value' => 8.99,
                    'amount' => 2
                ],
                [
                    'name' => 'Guiness',
                    'value' => 27.9,
                    'amount' => 3
                ]
            ]);
        
        $this->correiosServiceMock
            ->method('calculateShipping')
            ->willReturn(0.00);

        $result = $this->paymentService->calculatePayment();

        static::assertEquals($paymentDetails, $result);
    }

    /**
     * @dataProvider paymentDetailsWithValueLessThanOneHundredAndZipCodeParana
     */
    public function testCalculatePaymentWithValueLessThanOneHundredAndZipCodeParana($paymentDetails)
    {
        $this->shoppingCartBusinessMock
            ->method('getUserData')
            ->willReturn([
                'name' => 'Dagoberto',
                'zipCode' => '82630280'
            ]);

        $this->shoppingCartBusinessMock
            ->method('getShoppingList')
            ->willReturn([
                [
                    'name' => 'Trakinas',
                    'value' => 2.5,
                    'amount' => 5
                ],
                [
                    'name' => 'Coke 2L',
                    'value' => 8.99,
                    'amount' => 2
                ]
            ]);

        $this->correiosServiceMock
            ->method('calculateShipping')
            ->willReturn(25.00);

        $result = $this->paymentService->calculatePayment();

        static::assertEquals($paymentDetails, $result);
    }

    /**
     * @dataProvider paymentDetailsWithValueLessThanOneHundredAndZipMinasGerais
     */
    public function testCalculatePaymentWithValueLessThanOneHundredAndZipCodeMinasGerais($paymentDetails)
    {
        $this->shoppingCartBusinessMock
            ->method('getUserData')
            ->willReturn([
                'name' => 'Dagoberto',
                'zipCode' => '33858240'
            ]);

        $this->shoppingCartBusinessMock
            ->method('getShoppingList')
            ->willReturn([
                [
                    'name' => 'Trakinas',
                    'value' => 2.5,
                    'amount' => 5
                ],
                [
                    'name' => 'Coke 2L',
                    'value' => 8.99,
                    'amount' => 2
                ]
            ]);

        $this->correiosServiceMock
            ->method('calculateShipping')
            ->willReturn(50.00);

        $result = $this->paymentService->calculatePayment();

        static::assertEquals($paymentDetails, $result);
    }

    public function paymentDetailsWithValueGreaterThanOneHundred()
    {
        $paymentDetails = [
            'client' => [
                'name' => 'Dagoberto',
                'zipCode' => 82630280
            ],
            'products' => [
                [
                    'name' => 'Trakinas',
                    'value' => 2.5,
                    'amount' => 5
                ],
                [
                    'name' => 'Coke 2L',
                    'value' => 8.99,
                    'amount' => 2
                ],
                [
                    'name' => 'Guiness',
                    'value' => 27.9,
                    'amount' => 3
                ]
            ],
            'shoppingCartValue' => 114.18,
            'shippingPrice' => 0,
            'totalWithShipping' => 114.18
        ];

        return [
            [$paymentDetails]
        ];
    }

    public function paymentDetailsWithValueLessThanOneHundredAndZipCodeParana()
    {
        $paymentDetails = [
            'client' => [
                'name' => 'Dagoberto',
                'zipCode' => '82630280'
            ],
            'products' => [
                [
                    'name' => 'Trakinas',
                    'value' => 2.5,
                    'amount' => 5
                ],
                [
                    'name' => 'Coke 2L',
                    'value' => 8.99,
                    'amount' => 2
                ]
            ],
            'shoppingCartValue' => 30.48,
            'shippingPrice' => 25,
            'totalWithShipping' => 55.48
        ];

        return [
            [$paymentDetails]
        ];
    }

    public function paymentDetailsWithValueLessThanOneHundredAndZipMinasGerais()
    {
        $paymentDetails = [
            'client' => [
                'name' => 'Dagoberto',
                'zipCode' => '33858240'
            ],
            'products' => [
                [
                    'name' => 'Trakinas',
                    'value' => 2.5,
                    'amount' => 5
                ],
                [
                    'name' => 'Coke 2L',
                    'value' => 8.99,
                    'amount' => 2
                ]
            ],
            'shoppingCartValue' => 30.48,
            'shippingPrice' => 50,
            'totalWithShipping' => 80.48
        ];

        return [
            [$paymentDetails]
        ];
    }
}