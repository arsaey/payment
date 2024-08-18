<?php

namespace Blognevis\Payments;

use Illuminate\Support\Facades\Facade;

class ZarinpalPaymentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'zarinpal';
    }
}
