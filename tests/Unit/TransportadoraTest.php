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
use function PHPUnit\Framework\assertEquals;
use PHPUnit\Framework\TestCase;

class TransportadoraTest extends TestCase
{
    public function test_index(): void
    {
        $request = new PaginacaoRequest();
        $resource = (object) [];
        $resultadoEsperado = new JsonResponse($resource);
        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('obterTodos')->andReturn($resource);

        $resultado = (new TransportadoraController($servico))->index($request);
        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_show(): void
    {
        $id = '1';
        $resource = new Transportadora();
        $resultadoEsperado = new JsonResponse($resource);
        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('obterPor')->andReturn($resource);

        $resultado = (new TransportadoraController($servico))->show($id);

        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_create(): void
    {

        $request = new CriarTransportadoraRequest([
            'nome' => fake()->name(),
            'cnpj' => Generator::cnpj(),
        ]);

        $resultadoEsperado = new JsonResponse(
            'Transportadora criada com sucesso.',
            Response::HTTP_CREATED
        );

        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('criar');

        $resultado = (new TransportadoraController($servico))->store($request);

        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_update(): void
    {
        $id = '1';
        $request = new AtualizarTransportadoraRequest([
            'nome' => fake()->name(),
            'cnpj' => Generator::cnpj(),
        ]);

        $resultadoEsperado = new JsonResponse(
            null,
            Response::HTTP_NO_CONTENT
        );

        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('atualizar');

        $resultado = (new TransportadoraController($servico))->update($request, $id);

        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_delete(): void
    {
        $id = '1';

        $resultadoEsperado = new JsonResponse(
            null,
            Response::HTTP_NO_CONTENT
        );

        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('deletar');

        $resultado = (new TransportadoraController($servico))->destroy($id);

        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_delete_em_massa(): void
    {
        $id = '1,2,3,4';

        $resultadoEsperado = new JsonResponse(
            null,
            Response::HTTP_NO_CONTENT
        );

        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('deletar');

        $resultado = (new TransportadoraController($servico))->destroy($id);

        assertEquals($resultado, $resultadoEsperado);
    }
}
