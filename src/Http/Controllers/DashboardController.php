<?php

namespace Blognevis\Payments\Http\Controllers;

use Blognevis\Payments\Models\Logger as PaymentsLogger;
use Illuminate\Http\Request;
use Blognevis\Payments\Models\Logger;

/*
 * This file is part of the Laravel NOWPayments package.
 *
 * (c) Prevail Ejimadu <prevailexcellent@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class DashboardController
{
    public function __invoke(Request $request)
    {
        $logs = PaymentsLogger::get();
        return view('payments::dashboard', compact('logs'));
    }
}
