<?php

namespace App\Providers;

use App\Services\NominatimService;
use GuzzleHttp\Client;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use App\Services\GeocodioService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(NominatimService::class, function ($app) {
            $httpClient = new Client();
            return new NominatimService($httpClient);
        });
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrapFive();
    }
}
