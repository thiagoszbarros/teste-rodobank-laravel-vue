<?php

namespace Tests\Unit;

use App\Http\Controllers\MotoristaController;
use App\Http\Requests\AtualizarMotoristaRequest;
use App\Http\Requests\CriarMotoristaRequest;
use App\Http\Requests\PaginacaoRequest;
use App\Interfaces\CRUD;
use App\Models\Motorista;
use Avlima\PhpCpfCnpjGenerator\Generator;
use DateInterval;
use DateTime;
use Illuminate\Http\JsonResponse;
use Mockery;
use function PHPUnit\Framework\assertEquals;
use PHPUnit\Framework\TestCase;

class MotoristaTest extends TestCase
{
    public function test_index(): void
    {
        $request = new PaginacaoRequest();
        $resource = (object) [];
        $resultadoEsperado = new JsonResponse($resource);
        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('obterTodos')->andReturn($resource);

        $resultado = (new MotoristaController($servico))->index($request);
        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_show(): void
    {
        $id = '1';
        $resource = new Motorista();
        $resultadoEsperado = new JsonResponse($resource);
        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('obterPor')->andReturn($resource);

        $resultado = (new MotoristaController($servico))->show($id);

        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_create(): void
    {

        $request = new CriarMotoristaRequest([
            'nome' => fake()->name(),
            'cpf' => Generator::cpf(),
            'data_nascimento' => (new DateTime())->sub(new DateInterval('P18Y'))->format('d-m-Y'),
            'email' => fake()->email(),
        ]);

        $resultadoEsperado = new JsonResponse(
            'Motorista criado com sucesso.',
            JsonResponse::HTTP_CREATED
        );

        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('criar');

        $resultado = (new MotoristaController($servico))->store($request);

        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_update(): void
    {
        $id = '1';
        $request = new AtualizarMotoristaRequest([
            'nome' => fake()->name(),
            'cpf' => Generator::cpf(),
            'data_nascimento' => (new DateTime())->sub(new DateInterval('P18Y'))->format('d-m-Y'),
            'email' => fake()->email(),
        ]);

        $resultadoEsperado = new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );

        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('atualizar');

        $resultado = (new MotoristaController($servico))->update($request, $id);

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

        $resultado = (new MotoristaController($servico))->destroy($id);

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

        $resultado = (new MotoristaController($servico))->destroy($id);

        assertEquals($resultado, $resultadoEsperado);
    }
}
