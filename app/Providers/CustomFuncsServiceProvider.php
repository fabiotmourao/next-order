<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\CustomFuncs;

class CustomFuncsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('CustomFuncs', function () {
            return new CustomFuncs();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
