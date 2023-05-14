<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Interfaces\ITransportadora;
use App\Http\Requests\CriacaoTransportadoraRequest;
use App\Http\Requests\AtualizarTransportadoraRequest;

class TransportadoraController extends Controller
{
    public function __construct(
        private readonly ITransportadora $transportadora
    ) {
    }

    public function index()
    {
        try {
            return new Response([
                'data' => $this->transportadora->obterTodos(),
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
                'data' => $this->transportadora->obterPor($id),
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

    public function store(CriacaoTransportadoraRequest $request)
    {
        try {
            $this->transportadora->criar([
                'nome' => $request->nome,
                'cnpj' => $request->cnpj,
            ]);

            return new Response([
                'data' => 'Transportadara criada com sucesso.',
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

    public function update(AtualizarTransportadoraRequest $request, int $id)
    {
        try {
            $this->transportadora->atualizar($id, [
                'nome' => $request->nome,
                'status' => $request->status,
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

    public function delete(int $id)
    {
        try {
            $this->transportadora->deletar($id);

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
