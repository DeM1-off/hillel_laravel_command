<?php

namespace App\Providers;

use App\Service\StatService;
use App\Service\StatServiceInteface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StatServiceInteface::class,StatService::class);
    }
}
