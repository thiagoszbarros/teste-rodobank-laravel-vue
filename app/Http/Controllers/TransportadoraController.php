<?php

namespace App\Http\Controllers;

use App\Interfaces\CRUD;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\CriarTransportadoraRequest;
use App\Http\Requests\AtualizarTransportadoraRequest;

class TransportadoraController extends Controller
{
    public function __construct(
        private readonly CRUD $transportadora
    ) {
    }

    public function index(Request $request)
    {
        try {
            return new Response([
                'data' => $this->transportadora->obterTodos($request->query('offset')),
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

    public function store(CriarTransportadoraRequest $request)
    {
        try {
            $this->transportadora->criar($request->all());

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
            $this->transportadora->atualizar($id, $request->all());

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
