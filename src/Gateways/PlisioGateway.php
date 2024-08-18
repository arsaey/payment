<?php

namespace Blognevis\Payments\Gateways;

use Blognevis\Payments\PlisioPaymentFacade;

class PlisioGateway
{
    public function pay($data)
    {
        $response = PlisioPaymentFacade::createTransaction($data);

        //Check the response and, depending on the result, redirect the user to Plisio for further payment or return to the checkout page with an error.
        if ($response && $response['status'] !== 'error' && !empty($response['data'])) {
            return ['msg' => "Payment created successfully", 'type' => 'success', 'data' => $response['data']['invoice_url']];
        } else {
            $errorMessage = implode(',', json_decode($response['data']['message'], true));
        }

    }

    public function verify($data)
    {
        //callback.php
        $callbackData = $_POST;

        if (PlisioPaymentFacade::verifyCallbackData($callbackData)) {
            //Change invoice status, notify user etc.
        } else {
            //HTTP 403 error. Callback data is not valid!
        }
    }
}
