<?php

namespace ThomasInckx\PodioLogger;


use Illuminate\Support\ServiceProvider;

class PodioLoggerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('podio-logger', function () {
            $config = config('logging.channels.podio');

            return new PodioLogger($config);
        });
    }
}