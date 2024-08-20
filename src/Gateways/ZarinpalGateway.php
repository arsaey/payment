<?php

namespace Blognevis\Payments\Gateways;

use Blognevis\Payments\Models\Logger;
use Blognevis\Payments\ZarinpalPaymentFacade;

class ZarinpalGateway
{

    public function pay($data)
    {
        $response = ZarinpalPaymentFacade::request($data);
        $code = $response['data']['code'];
        $message = ZarinpalPaymentFacade::getCodeMessage($code);
        if ($code === 100) {
            $authority = $response['data']['authority'];
            $redirectUrl = ZarinpalPaymentFacade::getRedirectUrl($authority);
            return ['msg' => "Payment created successfully", 'payment_url' => $redirectUrl, 'type' => 'success', 'other_data' => $response];
        }
        throw new \Exception("Error, Code: " . $code . ", Message: " . $message . "}");
    }

    public function verify($data)
    {
        // data = ['amount','autority']
        $response = ZarinpalPaymentFacade::verify($data);
        $code = $response['data']['code'];
        $message = ZarinpalPaymentFacade::getCodeMessage($code);
        if($code === 100) {
            $refId = $response['data']['ref_id'];
            Logger::where('payment_id', $data['autority'])->update([
                'status' => 'completed'
            ]);
            return ['is_complete_payment' => true, 'status' => 'completed', 'other_data' => $response];
       
        }
        throw new \Exception("Error, Code: " . $code . ", Message: " . $message . "}");
       
    }

}
