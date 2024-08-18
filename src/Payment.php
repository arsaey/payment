<?php

namespace Blognevis\Payments;

use Blognevis\Payments\Gateways\ZarinpalGateway;
use Blognevis\Payments\Gateways\PlisioGateway;
use Blognevis\Payments\Gateways\NowPaymentsGateway;

class Payment
{
    protected $gateway;

    public function __construct($gateway = null)
    {
        $this->gateway = $gateway ?: config('payments.default_gateway');
    }

    public function gateway($name)
    {
        switch ($name) {
            case 'zarinpal':
                return new ZarinpalGateway();
            case 'plisio':
                return new PlisioGateway();
            case 'nowpayments':
                return new NowPaymentsGateway();
            default:
                throw new \Exception("Unsupported payment gateway: $name");
        }
    }

    public function pay($data)
    {
        return $this->gateway($this->gateway)->pay($data);
    }

    public function verify($data)
    {
        return $this->gateway($this->gateway)->verify($data);
    }
    
}
