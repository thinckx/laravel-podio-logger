<?php

namespace ThomasInckx\PodioLogger\Tests;

use ThomasInckx\PodioLogger\Facades\PodioLogger;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use ThomasInckx\PodioLogger\PodioLoggerServiceProvider;

class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     * @param  \Illuminate\Foundation\Application $app
     * @return ThomasInckx\PodioLogger\MyPackageServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [
            PodioLoggerServiceProvider::class
        ];
    }    /**
     * Load package alias
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'podio-logger' => PodioLogger::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('logging.channels.stack.channels', ['podio']);
        $app['config']->set('logging.channels.podio', [
            'client_id' =>  env('PODIO_LOG_CLIENT_ID', ''),
            'client_secret' => env('PODIO_LOG_CLIENT_SECRET', ''),
            'app_id'    => env('PODIO_LOG_APP_ID', ''),
            'app_token' => env('PODIO_LOG_APP_TOKEN', ''),
            'driver'    =>  'monolog',
            'level'     =>  'debug',
            'handler'   =>  ThomasInckx\PodioLogger\PodioLoggerHandler::class,
            'app_name'  =>  env('APP_NAME', ''),
            'keys'   =>  [
                'level'     =>  'level',
                'message'   =>  'message',
                'app_name'  =>  'appname'
            ]
        ]);
    }
}