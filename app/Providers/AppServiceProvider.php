<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\CRUD;
use App\Http\Controllers\{
    TransportadoraController,
    MotoristaController,
    ModeloController,
};
use App\Services\{
    TransportadoraService,
    MotoristaService,
    ModeloService,
};


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app
            ->when(TransportadoraController::class)
            ->needs(CRUD::class)
            ->give(TransportadoraService::class);
        $this->app
            ->when(MotoristaController::class)
            ->needs(CRUD::class)
            ->give(MotoristaService::class);
        $this->app
            ->when(ModeloController::class)
            ->needs(CRUD::class)
            ->give(ModeloService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
