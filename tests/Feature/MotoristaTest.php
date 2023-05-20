<?php

namespace Tests\Feature;

use App\Models\Motorista;
use App\Models\Transportadora;
use Avlima\PhpCpfCnpjGenerator\Generator;
use DateInterval;
use DateTime;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->url = 'api/motoristas/';
    $this->motoristaId = Motorista::factory()->create()->id;
});

test('index', function () {
    $this->withoutMiddleware()
        ->get($this->url)
        ->assertStatus(Response::HTTP_OK);
});

test('show', function () {

    $this->withoutMiddleware()
        ->get($this->url.$this->motoristaId)
        ->assertStatus(Response::HTTP_OK);
});

test('store', function () {
    $this->withoutMiddleware()
        ->post(
            $this->url,
            [
                'nome' => fake()->name(),
                'cpf' => Generator::cpf(),
                'data_nascimento' => (new DateTime())->sub(new DateInterval('P18Y'))->format('d-m-Y'),
                'email' => fake()->email(),
                'transportadora_id' => Transportadora::factory()->create()->id,
            ]
        )
        ->assertStatus(Response::HTTP_CREATED);
});

test('update', function () {

    $this->withoutMiddleware()
        ->put(
            $this->url.$this->motoristaId,
            [
                'nome' => fake()->name(),
                'cpf' => Generator::cpf(),
                'data_nascimento' => (new DateTime())->sub(new DateInterval('P18Y'))->format('d-m-Y'),
                'email' => fake()->email(),
                'transportadora_id' => Transportadora::factory()->create()->id,
            ]
        )
        ->assertStatus(Response::HTTP_NO_CONTENT);
});

test('destroy', function () {

    $this->withoutMiddleware()
        ->delete($this->url.$this->motoristaId)
        ->assertStatus(Response::HTTP_NO_CONTENT);
});
