<?php 

namespace Blognevis\Payments;

use Illuminate\Support\Facades\Facade;
use PrevailExcel\Nowpayments\Facades\Nowpayments;


class NowpaymentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'nowpayments';
    }
}
