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
use function PHPUnit\Framework\assertEquals;
use PHPUnit\Framework\TestCase;

class ModeloTest extends TestCase
{
    public function test_index(): void
    {
        $request = new PaginacaoRequest();
        $resource = (object) [];
        $resultadoEsperado = new JsonResponse($resource);
        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('obterTodos')->andReturn($resource);

        $resultado = (new ModeloController($servico))->index($request);
        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_show(): void
    {
        $id = '1';
        $resource = new Modelo();
        $resultadoEsperado = new JsonResponse($resource);
        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('obterPor')->andReturn($resource);

        $resultado = (new ModeloController($servico))->show($id);

        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_create(): void
    {

        $request = new CriarModeloRequest([
            'nome' => fake()->name(),
        ]);

        $resultadoEsperado = new JsonResponse('Modelo criado com sucesso.',
            JsonResponse::HTTP_CREATED
        );

        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('criar');

        $resultado = (new ModeloController($servico))->store($request);

        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_update(): void
    {
        $id = '1';
        $request = new AtualizarModeloRequest([
            'nome' => fake()->name(),
        ]);

        $resultadoEsperado = new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );

        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('atualizar');

        $resultado = (new ModeloController($servico))->update($request, $id);

        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_delete(): void
    {
        $id = '1';

        $resultadoEsperado = new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );

        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('deletar');

        $resultado = (new ModeloController($servico))->destroy($id);

        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_delete_em_massa(): void
    {
        $id = '1,2,3,4';

        $resultadoEsperado = new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );

        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('deletar');

        $resultado = (new ModeloController($servico))->destroy($id);

        assertEquals($resultado, $resultadoEsperado);
    }
}
