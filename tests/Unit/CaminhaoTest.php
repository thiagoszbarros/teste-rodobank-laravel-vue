<?php

namespace Tests\Unit;

use App\Http\Controllers\CaminhaoController;
use App\Http\Requests\AtualizarCaminhaoRequest;
use App\Http\Requests\CriarCaminhaoRequest;
use App\Http\Requests\PaginacaoRequest;
use App\Interfaces\CRUD;
use App\Models\Caminhao;
use Illuminate\Http\JsonResponse;
use Mockery;
use function PHPUnit\Framework\assertEquals;
use PHPUnit\Framework\TestCase;

class CaminhaoTest extends TestCase
{
    public function test_index(): void
    {
        $request = new PaginacaoRequest();
        $resource = (object) [];
        $resultadoEsperado = new JsonResponse($resource);
        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('obterTodos')->andReturn($resource);

        $resultado = (new CaminhaoController($servico))->index($request);
        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_show(): void
    {
        $id = '1';
        $resource = new Caminhao();
        $resultadoEsperado = new JsonResponse($resource);
        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('obterPor')->andReturn($resource);

        $resultado = (new CaminhaoController($servico))->show($id);

        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_create(): void
    {

        $request = new CriarCaminhaoRequest([
            'nome' => fake()->name(),
        ]);

        $resultadoEsperado = new JsonResponse(
            'Caminhao criado com sucesso.',
            JsonResponse::HTTP_CREATED
        );

        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('criar');

        $resultado = (new CaminhaoController($servico))->store($request);

        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_update(): void
    {
        $id = '1';
        $request = new AtualizarCaminhaoRequest([
            'nome' => fake()->name(),
        ]);

        $resultadoEsperado = new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );

        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('atualizar');

        $resultado = (new CaminhaoController($servico))->update($request, $id);

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

        $resultado = (new CaminhaoController($servico))->destroy($id);

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

        $resultado = (new CaminhaoController($servico))->destroy($id);

        assertEquals($resultado, $resultadoEsperado);
    }
}
