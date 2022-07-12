<?php

namespace App\Services;

use App\Business\ShoppingCartBusiness;

class PaymentService
{
    // - Um serviço que recebe o carrinho, e retorna o valor final para o usuário
    private $shoppingCartBusiness;
    private $correiosService;
    private $paymentDetails;

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
        $this->setClientData();
        $this->setShoppingCartValue(); 
        $this->setTotalShoppingCartValue();
        $this->setShippingValue();
        
        $this->paymentDetails['totalWithShipping'] = $this->paymentDetails['shoppingCartValue'] + $this->paymentDetails['shippingPrice'];

        return $this->paymentDetails;
    }

    private function setClientData()
    {
        $this->paymentDetails['client'] = $this->shoppingCartBusiness->getUserData();
    }

    private function setShoppingCartValue()
    {
        $this->paymentDetails['products'] = $this->shoppingCartBusiness->getShoppingList();
    }

    private function setTotalShoppingCartValue()
    {
        $totalShoppingCartValue = 0;

        foreach($this->paymentDetails['products'] as $product) {
            $totalShoppingCartValue += ($product['value'] * $product['amount']);
        }

        $this->paymentDetails['shoppingCartValue'] = $totalShoppingCartValue;
    }

    private function setShippingValue()
    {
        $totalShoppingValue = $this->paymentDetails['shoppingCartValue'];

        $shippingPrice = $totalShoppingValue < 100 
            ? $this->correiosService->calculateShipping()
            : 0;
        
        $this->paymentDetails['shippingPrice'] = $shippingPrice;

        $totalShoppingValue += $shippingPrice;
    }
}