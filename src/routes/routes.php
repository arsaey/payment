<?php

use Illuminate\Support\Facades\Route;
use Blognevis\Payments\Http\Controllers\DashboardController;
use Blognevis\Payments\Http\Middleware\Authorize;

/*
 * This file is part of the Laravel payments package.
 *
 * (c) Prevail Ejimadu <prevailexcellent@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group([
	'prefix'  =>  config('payments.nowpayments.path', 'blognevis-payments'),
	'middleware' => config('payments.nowpayments.middleware', [Authorize::class]),
], function () {
	Route::get('/', DashboardController::class)->name('payments.dashboard');
});
