<?php

namespace Zarinpal;

use Illuminate\Support\ServiceProvider;
use Zarinpal\Clients\GuzzleClient;

class ZarinpalServiceProvider extends ServiceProvider
{
    /**
     * Register default config
     * and main class instance.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/zarinpal.php', 'zarinpal');
        $this->app->instance(Zarinpal::class, $this->getInstance());
    }

    private function getInstance()
    {
        $merchantID = (string) config('payments.zarinpal.merchantID', 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx');
        $lang = (string) config('payments.zarinpal.lang', 'fa');
        $sandbox = (bool) config('payments.zarinpal.sandbox', '0');
        $zaringate = (bool) config('payments.zarinpal.zaringate', '0');
        $zaringatePSP = (string) config('payments.zarinpal.zaringate_psp', '');
        $client = new GuzzleClient($sandbox);
        return new Zarinpal($merchantID, $client, $lang, $sandbox, $zaringate, $zaringatePSP, true);
    }
}
