<?php

namespace Blognevis\Payments\Gateways;

use Blognevis\Payments\NowpaymentFacade;

class NowPaymentsGateway
{

    public function pay($params)
    {
        $nowPaymentResponse = NowpaymentFacade::createPayment($params);
        return ['msg' => "Payment created successfully", 'type' => 'success', 'data' => $nowPaymentResponse];

    }

    public function verify($data)
    {
        NowpaymentFacade::getPaymentStatus();
    }
}
