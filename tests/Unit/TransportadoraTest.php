<?php

namespace Tests\Unit;

use App\Http\Controllers\TransportadoraController;
use App\Http\Requests\AtualizarTransportadoraRequest;
use App\Http\Requests\CriarTransportadoraRequest;
use App\Http\Requests\PaginacaoRequest;
use App\Interfaces\CRUD;
use App\Models\Transportadora;
use Avlima\PhpCpfCnpjGenerator\Generator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Mockery;

test('Index', function () {
    $request = new PaginacaoRequest();
    $resource = (object) [];
    $resultadoEsperado = new JsonResponse($resource);
    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('obterTodos')->andReturn($resource);

    $resultado = (new TransportadoraController($servico))->index($request);

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Show', function () {
    $resource = new Transportadora();
    $resultadoEsperado = new JsonResponse($resource);
    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('obterPor')->andReturn($resource);

    $resultado = (new TransportadoraController($servico))->show('1');

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Create', function () {

    $resultadoEsperado = new JsonResponse(
        'Transportadora criada com sucesso.',
        Response::HTTP_CREATED
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('criar');

    $resultado = (new TransportadoraController($servico))->store(new CriarTransportadoraRequest([
        'nome' => fake()->name(),
        'cnpj' => Generator::cnpj(),
    ]));

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Update', function () {
    $resultadoEsperado = new JsonResponse(
        null,
        Response::HTTP_NO_CONTENT
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('atualizar');

    $resultado = (new TransportadoraController($servico))->update(new AtualizarTransportadoraRequest([
        'nome' => fake()->name(),
        'cnpj' => Generator::cnpj(),
    ]), '1');

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Delete', function () {
    $resultadoEsperado = new JsonResponse(
        null,
        Response::HTTP_NO_CONTENT
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('deletar');

    $resultado = (new TransportadoraController($servico))->destroy('1');

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Delete em massa', function () {
    $resultadoEsperado = new JsonResponse(
        null,
        Response::HTTP_NO_CONTENT
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('deletar');

    $resultado = (new TransportadoraController($servico))->destroy('1,2,3,4');

    expect($resultado)->toEqual($resultadoEsperado);
});
