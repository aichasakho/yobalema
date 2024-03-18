<?php

namespace App\Providers;

use App\Services\OpenWeatherMapService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(OpenWeatherMapService::class, function () {
            // Vous pouvez récupérer la clé API à partir de votre configuration Laravel (.env, config, etc.)
            $apiKey = config('services.open_weather_map.api_key');

            return new OpenWeatherMapService($apiKey);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
