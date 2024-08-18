<?php

namespace Blognevis\Payments;

use Illuminate\Support\ServiceProvider;
use PrevailExcel\Nowpayments\Facades\Nowpayments;
use Plisio\PlisioSdkLaravel\Payment;
use Zarinpal\Zarinpal;

class PaymentsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('nowpayments', function () {
            return  Nowpayments::getFacadeRoot();
        });

        $this->app->singleton('plisio', function () {
            return new Payment(config('payments.plisio.api_key'));
        });

        $this->app->singleton('zarinpal', function () {
            return app(Zarinpal::class);
        });

        $this->mergeConfigFrom(__DIR__.'/config/payments.php', 'payments');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
        $this->loadViewsFrom(__DIR__.'/resources/views/','payments');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/payments.php' => config_path('payments.php'),
        ], 'config');
    }
}
