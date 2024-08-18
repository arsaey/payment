<?php

namespace Blognevis\Payments\Gateways;

use Blognevis\Payments\NowpaymentFacade;

class NowPaymentsGateway
{

    public function pay($params)
    {
        $params = [
            'price_amount' => 100,       // Amount to charge
            'price_currency' => 'USD',     // Currency to charge in
            'pay_currency' => 'BTC',     // Cryptocurrency to accept
            'ipn_callback_url' => 'https://yourdomain.com/ipn', // Your IPN callback URL
        ];
        $nowPaymentResponse = NowpaymentFacade::createPayment($params);
        return ['msg' => "Payment created successfully", 'type' => 'success', 'data' => $nowPaymentResponse];

    }

    public function verify($data)
    {
        NowpaymentFacade::getPaymentStatus();
    }
}
