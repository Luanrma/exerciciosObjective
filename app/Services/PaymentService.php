<?php

namespace App\Services;

use App\Business\ShoppingCartBusiness;
use App\Interfaces\CorreriosInterface;

class PaymentService implements CorreriosInterface
{
    private object $shoppingCartBusiness;
    private object $correiosService;
    private array $paymentDetails;

    public function __construct(
        ShoppingCartBusiness $shoppingCartBusiness,
        CorreiosService $correiosService
    )
    {
        $this->shoppingCartBusiness = $shoppingCartBusiness;
        $this->correiosService = $correiosService;
    }

    public function calculatePayment()
    {
        $this->paymentDetails['client'] = $this->buildClientData();
        $this->paymentDetails['products'] = $this->buildShoppingCartValue(); 
        $this->paymentDetails['shoppingCartValue'] = $this->calculateTotalShoppingCartValue();
        $this->paymentDetails['shippingPrice'] = $this->calculateShipping($this->paymentDetails['client']['zipCode']);
        $this->paymentDetails['totalWithShipping'] = $this->calculateTotalPayment();

        return $this->paymentDetails;
    }

    public function calculateShipping(string $zipCode): float
    {
        $totalShoppingValue = $this->paymentDetails['shoppingCartValue'];

        $shippingPrice = $totalShoppingValue < 100 
            ? $this->correiosService->calculateShipping($zipCode)
            : 0;
        
        $this->paymentDetails['shippingPrice'] = $this->paymentDetails['shoppingCartValue'] + $shippingPrice;

        return $shippingPrice;
    }

    private function calculateTotalPayment()
    {
        return $this->paymentDetails['shoppingCartValue'] + $this->paymentDetails['shippingPrice'];
    }

    private function buildClientData()
    {
        return $this->shoppingCartBusiness->getUserData();
    }

    private function buildShoppingCartValue()
    {
        return $this->shoppingCartBusiness->getShoppingList();
    }

    private function calculateTotalShoppingCartValue()
    {
        $totalShoppingCartValue = 0;

        foreach($this->paymentDetails['products'] as $product) {
            $totalShoppingCartValue += ($product['value'] * $product['amount']);
        }

        return $totalShoppingCartValue;
    }
}