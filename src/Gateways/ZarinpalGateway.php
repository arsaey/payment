<?php

namespace Blognevis\Payments\Gateways;
use Blognevis\Payments\ZarinpalPaymentFacade;

class ZarinpalGateway
{

    public function pay($data)
    {
        return ZarinpalPaymentFacade::request($data);
    }

    public function verify($data)
    {
        return ZarinpalPaymentFacade::verify($data);
    }

}
