<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\Interface\AuthInterface;
use App\Services\Interface\CostumerInterface;
use App\Services\Interface\PackageInterface;
use App\Services\PackageService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AuthInterface::class,AuthService::class);
        $this->app->singleton(CostumerInterface::class,CostomerService::class);
        $this->app->singleton(PackageInterface::class,PackageService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
