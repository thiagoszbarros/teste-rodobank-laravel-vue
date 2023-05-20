<?php

namespace Tests\Unit;

use App\Http\Controllers\ModeloController;
use App\Http\Requests\AtualizarModeloRequest;
use App\Http\Requests\CriarModeloRequest;
use App\Http\Requests\PaginacaoRequest;
use App\Interfaces\CRUD;
use App\Models\Modelo;
use Illuminate\Http\JsonResponse;
use Mockery;

test('Index', function () {
    $request = new PaginacaoRequest();
    $resource = (object) [];
    $resultadoEsperado = new JsonResponse($resource);
    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('obterTodos')->andReturn($resource);

    $resultado = (new ModeloController($servico))->index($request);

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Show', function () {
    $id = '1';
    $resource = new Modelo();
    $resultadoEsperado = new JsonResponse($resource);
    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('obterPor')->andReturn($resource);

    $resultado = (new ModeloController($servico))->show($id);

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Store', function () {

    $resultadoEsperado = new JsonResponse(
        'Modelo criado com sucesso.',
        JsonResponse::HTTP_CREATED
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('criar');

    $resultado = (new ModeloController($servico))->store(new CriarModeloRequest([
        'nome' => fake()->name(),
    ]));

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Update', function () {

    $resultadoEsperado = new JsonResponse(
        null,
        JsonResponse::HTTP_NO_CONTENT
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('atualizar');

    $resultado = (new ModeloController($servico))->update(
        new AtualizarModeloRequest([
            'nome' => fake()->name(),
        ]),
        '1'
    );

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Delete', function () {
    $id = '1';

    $resultadoEsperado = new JsonResponse(
        null,
        JsonResponse::HTTP_NO_CONTENT
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('deletar');

    $resultado = (new ModeloController($servico))->destroy($id);

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Delete em massa', function () {
    $id = '1,2,3,4';

    $resultadoEsperado = new JsonResponse(
        null,
        JsonResponse::HTTP_NO_CONTENT
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('deletar');

    $resultado = (new ModeloController($servico))->destroy($id);

    expect($resultado)->toEqual($resultadoEsperado);
});
