<?php

namespace Blognevis\Payments\Gateways;

use Blognevis\Payments\Models\Logger;
use Blognevis\Payments\PlisioPaymentFacade;

class PlisioGateway
{
    public function pay($data)
    {
        $response = PlisioPaymentFacade::createTransaction($data);
        if($response['status']=='error'){
            throw new \Exception("Error, ".$response['data']['name'].':'.$response['data']['message']);
        }
        Logger::create([
            'payment_id' => $response['payment_id'],
            'status' => 'waiting',
            'gateway' => 'plisio',
            'amount' => $response['data']['amount']
        ]);

        return ['msg' => "Payment created successfully", 'payment_url' => $response['data']['invoice_url'], 'type' => 'success', 'other_data' => $response];
    }

    public function verify($data)
    {
        // data=$post
        //callback.php
        $callbackData = $data;

        $validated = PlisioPaymentFacade::verifyCallbackData($callbackData);
        if ($validated) {
            Logger::where('payment_id', $callbackData['txn_id'])->update([
                'status' => $$callbackData['status']
            ]);
            return ['is_complete_payment' => $callbackData['status']=='completed', 'status' => $callbackData['status'], 'other_data' => $callbackData];
        }
        throw new \Exception("Error, Code: " . 403 . ", Message: " . 'not a valid response' . "}");

    }
}
