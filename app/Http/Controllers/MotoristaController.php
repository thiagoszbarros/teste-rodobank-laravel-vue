<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtualizarMotoristaRequest;
use App\Http\Requests\CriarMotoristaRequest;
use App\Interfaces\CRUD;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MotoristaController extends Controller
{
    public function __construct(
        private CRUD $motorista
    ) {
    }

    public function index(Request $request)
    {
        try {
            return new Response([
                'data' => $this->motorista->obterTodos($request->query('offset')),
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

    public function show(string $id)
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
            $this->motorista->criar($request->all());

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

    public function update(AtualizarMotoristaRequest $request, string $id)
    {
        try {
            $this->motorista->atualizar($id, $request->all());

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

    public function destroy(string $id)
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
