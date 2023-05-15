<?php

namespace App\Providers;

use App\Http\Controllers\CaminhaoController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\TransportadoraController;
use App\Interfaces\CRUD;
use App\Services\CaminhaoService;
use App\Services\ModeloService;
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
        $this->app
            ->when(CaminhaoController::class)
            ->needs(CRUD::class)
            ->give(CaminhaoService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
