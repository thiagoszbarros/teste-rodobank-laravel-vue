<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [App\Http\Controllers\Auth\AuthController::class, 'login']);

Route::group(['middleware' => ['jwtAuth']], function () {
    Route::get('users', function () {
        return new Response([
            'data' => App\Models\User::select('id', 'email')->get(),
        ]);
    });

    Route::apiResource('transportadoras', App\Http\Controllers\TransportadoraController::class);
    Route::apiResource('motoristas', App\Http\Controllers\MotoristaController::class);
    Route::apiResource('modelos', App\Http\Controllers\ModeloController::class);
    Route::apiResource('caminhoes', App\Http\Controllers\CaminhaoController::class);
});
