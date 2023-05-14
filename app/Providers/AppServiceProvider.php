<?php

namespace App\Providers;

use App\Interfaces\IMotorista;
use App\Interfaces\ITransportadora;
use App\Services\MotoristaService;
use App\Services\TransportadoraService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ITransportadora::class, TransportadoraService::class);
        $this->app->bind(IMotorista::class, MotoristaService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
