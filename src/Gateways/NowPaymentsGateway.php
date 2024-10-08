<?php

namespace Blognevis\Payments\Gateways;

use Blognevis\Payments\Models\Logger;
use Blognevis\Payments\NowpaymentFacade;
use Exception;

class NowPaymentsGateway
{

    public function pay($params)
    {
        $nowPaymentResponse = NowpaymentFacade::createInvoice($params);

        Logger::create([
            'payment_id' => $nowPaymentResponse['id'],
            'status' => 'waiting',
            'gateway' => 'nowpayments',
            'amount' => $nowPaymentResponse['price_amount']
        ]);

        return ['msg' => "Payment created successfully", 'payment_url' => $nowPaymentResponse['invoice_url'], 'type' => 'success', 'other_data' => $nowPaymentResponse];

    }

    public function verify($data)
    {
        $res = NowpaymentFacade::getPaymentStatus($data);
        Logger::where('gateway','nowpayments')->where('payment_id', $res['invoice_id'])->update([
            'status' => $res['payment_status']
        ]);
        return ['is_complete_payment'=>in_array($res['payment_status'],['confirmed','sending','finished']),'status' => $res['payment_status'], 'other_data' => $res];
    }
}
