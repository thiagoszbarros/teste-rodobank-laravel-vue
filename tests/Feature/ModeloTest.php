<?php

use App\Models\Modelo;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->url = 'api/modelos/';
    $this->modeloId = Modelo::factory()->create()->id;
});

test('index', function () {
    $this->withoutMiddleware()
        ->get($this->url)
        ->assertStatus(Response::HTTP_OK);
});

test('show', function () {
    $this->withoutMiddleware()
        ->get($this->url.$this->modeloId)
        ->assertStatus(Response::HTTP_OK);
});

test('store', function () {
    $this->withoutMiddleware()
        ->post(
            $this->url,
            [
                'nome' => fake()->word(),
            ]
        )
        ->assertStatus(Response::HTTP_CREATED);
});

test('update', function () {

    $this->withoutMiddleware()
        ->put(
            $this->url.$this->modeloId,
            [
                'nome' => fake()->word(),
            ]
        )
        ->assertStatus(Response::HTTP_NO_CONTENT);
});

test('destroy', function () {
    $this->withoutMiddleware()
        ->delete($this->url.$this->modeloId)
        ->assertStatus(Response::HTTP_NO_CONTENT);
});
