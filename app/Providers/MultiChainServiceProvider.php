<?php

namespace App\Providers;

use App\Repositories\MultiChainInterface;
use App\Repositories\MultiChainRepository;
use Illuminate\Support\ServiceProvider;

class MultiChainServiceProvider extends ServiceProvider
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
        $this->app->bind(MultiChainInterface::class, function () {
            return new MultiChainRepository;
        });
    }
}