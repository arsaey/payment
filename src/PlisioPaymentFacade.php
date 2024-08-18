<?php

namespace Blognevis\Payments;

use Illuminate\Support\Facades\Facade;

class PlisioPaymentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'plisio';
    }
}
