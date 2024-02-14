<?php

namespace DataDome\FraudSdkLaravel\Providers;

use DataDome\FraudSdkLaravel\Services\DataDomeService;
use DataDome\FraudSdkSymfony\Config\DataDomeOptions;
use DataDome\FraudSdkSymfony\DataDome;
use Illuminate\Support\ServiceProvider;

class DataDomeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('DataDome', function () {
            $options = new DataDomeOptions(
                config('datadome.fraud_api_key'),
                config('datadome.timeout',1500),
                config('datadome.endpoint', null));

            $dd = new DataDome($options);

            return new DataDomeService($dd);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/datadome.php' => config_path('datadome.php'),
        ], 'config');
    }
}
