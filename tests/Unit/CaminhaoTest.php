<?php

namespace Tests\Unit;

use Mockery;
use Exception;
use App\Interfaces\CRUD;
use App\Models\Caminhao;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\PaginacaoRequest;
use App\Http\Requests\CriarCaminhaoRequest;
use App\Http\Controllers\CaminhaoController;
use App\Http\Requests\AtualizarCaminhaoRequest;

test('index', function () {
    $request = new PaginacaoRequest();
    $resource = (object) [];
    $resultadoEsperado = new JsonResponse($resource);
    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('obterTodos')->andReturn($resource);

    $resultado = (new CaminhaoController($servico))->index($request);

    expect($resultado)->toEqual($resultadoEsperado);
});

test('show', function () {
    $id = '1';
    $resource = new Caminhao();
    $resultadoEsperado = new JsonResponse($resource);
    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('obterPor')->andReturn($resource);

    $resultado = (new CaminhaoController($servico))->show($id);

    expect($resultado)->toEqual($resultadoEsperado);
});

test('create', function () {
    $resultadoEsperado = new JsonResponse(
        'Caminhao criado com sucesso.',
        JsonResponse::HTTP_CREATED
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('criar');

    $resultado = (new CaminhaoController($servico))->store(
        new CriarCaminhaoRequest([
            'nome' => fake()->name(),
        ])
    );

    expect($resultado)->toEqual($resultadoEsperado);
});

test('update', function () {
    $resultadoEsperado = new JsonResponse(
        null,
        JsonResponse::HTTP_NO_CONTENT
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('atualizar');

    $resultado = (new CaminhaoController($servico))->update(
        new AtualizarCaminhaoRequest([
            'nome' => fake()->name(),
        ]),
        '1'
    );

    expect($resultado)->toEqual($resultadoEsperado);
});

test('delete', function () {

    $resultadoEsperado = new JsonResponse(
        null,
        JsonResponse::HTTP_NO_CONTENT
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('deletar');

    $resultado = (new CaminhaoController($servico))->destroy('1');

    expect($resultado)->toEqual($resultadoEsperado);
});

test('delete em massa', function () {
    $resultadoEsperado = new JsonResponse(
        null,
        JsonResponse::HTTP_NO_CONTENT
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('deletar');

    $resultado = (new CaminhaoController($servico))->destroy('1,2,3,4');

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Erro', function () {
    $request = new PaginacaoRequest();
    $ErroEsperado = new JsonResponse("Message", JsonResponse::HTTP_BAD_REQUEST);
    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('obterTodos')->andThrow(new Exception("Message"));
    $servico->shouldReceive('obterPor')->andThrow(new Exception("Message"));
    $servico->shouldReceive('criar')->andThrow(new Exception("Message"));
    $servico->shouldReceive('atualizar')->andThrow(new Exception("Message"));
    $servico->shouldReceive('deletar')->andThrow(new Exception("Message"));

    $resultadoIndex = (new CaminhaoController($servico))->index($request);
    $resultadoShow = (new CaminhaoController($servico))->show($request);
    $resultadoCreate = (new CaminhaoController($servico))->store(new CriarCaminhaoRequest);
    $resultadoUpdate = (new CaminhaoController($servico))->update(new AtualizarCaminhaoRequest, 1);
    $resultadoDelete = (new CaminhaoController($servico))->destroy(1);

    expect($resultadoIndex)->toEqual($ErroEsperado);
    expect($resultadoShow)->toEqual($ErroEsperado);
    expect($resultadoCreate)->toEqual($ErroEsperado);
    expect($resultadoUpdate)->toEqual($ErroEsperado);
    expect($resultadoDelete)->toEqual($ErroEsperado);
});
