<?php

namespace App\Http\Controllers;

use App\Http\Requests\CriarMotoristaRequest;
use Illuminate\Http\Response;
use App\Interfaces\IMotorista;
use Illuminate\Http\Request;

class MotoristaController extends Controller
{
    public function __construct(
        private IMotorista $motorista
    ) {
    }

    public function index()
    {
        try {
            return new Response([
                'data' => $this->motorista->obterTodos(),
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new Response(
                [
                    'data' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function show(int $id)
    {
        try {
            return new Response([
                'data' => $this->motorista->obterPor($id),
            ], Response::HTTP_OK);
        } catch (\Exception $e) {

            return new Response(
                [
                    'data' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function store(CriarMotoristaRequest $request)
    {
        try {
            $this->motorista->criar([
                'nome' => $request->nome,
                'cpf' => $request->cpf,
                'data_nascimento' => $request->data_nascimento,
                'email' => $request->email,
            ]);

            return new Response([
                'data' => 'Motorista criado com sucesso.',
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {

            return new Response(
                [
                    'data' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $this->motorista->atualizar($id, [
                'nome' => $request->nome,
                'data_nascimento' => $request->data_nascimento,
            ]);

            return new Response(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {

            return new Response(
                [
                    'data' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->motorista->deletar($id);

            return new Response(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new Response(
                [
                    'data' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
