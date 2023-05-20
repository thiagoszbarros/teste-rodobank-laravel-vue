<?php

namespace Tests\Feature;

use App\Models\Transportadora;
use Avlima\PhpCpfCnpjGenerator\Generator;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->url = 'api/transportadoras/';
    $this->transportadoraId = Transportadora::factory()->create()->id;
});

test('index', function () {

    $this->withoutMiddleware()
        ->get($this->url)
        ->assertStatus(Response::HTTP_OK);
});

test('show', function () {
    $this->withoutMiddleware()
        ->get($this->url.$this->transportadoraId)
        ->assertStatus(Response::HTTP_OK);
});

test('store', function () {
    $this->withoutMiddleware()
        ->post($this->url, [
            'nome' => fake()->name(),
            'cnpj' => Generator::cnpj(),
        ])->assertStatus(Response::HTTP_CREATED);
});

test('update', function () {
    $this->withoutMiddleware()
        ->put(
            $this->url.$this->transportadoraId,
            [
                'nome' => fake()->name(),
                'cnpj' => Generator::cnpj(),
            ]
        )
        ->assertStatus(Response::HTTP_NO_CONTENT);
});

test('destroy', function () {
    $this->withoutMiddleware()
        ->delete($this->url.$this->transportadoraId)
        ->assertStatus(Response::HTTP_NO_CONTENT);
});
