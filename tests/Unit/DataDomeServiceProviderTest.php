<?php

namespace DataDome\FraudSdkLaravel\Tests\Unit;

use DataDome\FraudSdkLaravel\Providers\DataDomeServiceProvider;
use DataDome\FraudSdkLaravel\Services\DataDomeService;
use Orchestra\Testbench\TestCase;

class DataDomeServiceProviderTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            DataDomeServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        config()->set('datadome.fraud_api_key', 'DataDomeParisNewYorkSingapore');
    }

    /** @test */
    public function it_registers_the_datadome_service()
    {
        $this->app->register(DataDomeServiceProvider::class);

        // Ensure that the 'DataDome' service is bound.
        $dataDomeService = $this->app->make('DataDome');

        $this->assertInstanceOf(DataDomeService::class, $dataDomeService);
    }

    /** @test */
    public function it_publishes_the_config_file()
    {
        // Run the boot method to publish the config file.
        $provider = new DataDomeServiceProvider($this->app);
        $provider->boot();

        // Define the path to the published config file.
        $configPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'datadome.php';

        $this->assertFileExists($configPath);
    }
}
