<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\RecipeSearchServiceInterface;
use App\Services\RecipeSearchService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
          RecipeSearchServiceInterface::class,
          RecipeSearchService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
