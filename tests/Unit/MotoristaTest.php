<?php

namespace Tests\Unit;

use App\Http\Controllers\MotoristaController;
use App\Http\Requests\AtualizarMotoristaRequest;
use App\Http\Requests\CriarMotoristaRequest;
use App\Interfaces\CRUD;
use App\Models\Motorista;
use Avlima\PhpCpfCnpjGenerator\Generator;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery;
use function PHPUnit\Framework\assertEquals;
use PHPUnit\Framework\TestCase;

class MotoristaTest extends TestCase
{
    public function test_index(): void
    {
        $request = new Request();
        $resource = (object) [];
        $resultadoEsperado = new Response([
            'data' => $resource,
        ]);
        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('obterTodos')->andReturn($resource);

        $resultado = (new MotoristaController($servico))->index($request);
        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_show(): void
    {
        $id = '1';
        $resource = new Motorista();
        $resultadoEsperado = new Response([
            'data' => $resource,
        ]);
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

        $resultadoEsperado = new Response(
            [
                'data' => 'Motorista criado com sucesso.',
            ],
            Response::HTTP_CREATED
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

        $resultadoEsperado = new Response(
            null,
            Response::HTTP_NO_CONTENT
        );

        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('atualizar');

        $resultado = (new MotoristaController($servico))->update($request, $id);

        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_delete(): void
    {
        $id = '1';

        $resultadoEsperado = new Response(
            null,
            Response::HTTP_NO_CONTENT
        );

        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('deletar');

        $resultado = (new MotoristaController($servico))->destroy($id);

        assertEquals($resultado, $resultadoEsperado);
    }

    public function test_delete_em_massa(): void
    {
        $id = '1,2,3,4';

        $resultadoEsperado = new Response(
            null,
            Response::HTTP_NO_CONTENT
        );

        $servico = Mockery::mock(CRUD::class);
        $servico->shouldReceive('deletar');

        $resultado = (new MotoristaController($servico))->destroy($id);

        assertEquals($resultado, $resultadoEsperado);
    }
}
