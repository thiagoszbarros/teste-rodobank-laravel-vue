<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtualizarCaminhaoRequest;
use App\Http\Requests\CriarCaminhaoRequest;
use App\Interfaces\CRUD;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CaminhaoController extends Controller
{
    public function __construct(
        private CRUD $caminhao
    ) {
    }

    public function index(Request $request)
    {
        try {
            return new Response([
                'data' => $this->caminhao->obterTodos($request->query('offset')),
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
                'data' => $this->caminhao->obterPor($id),
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

    public function store(CriarCaminhaoRequest $request)
    {
        try {
            $this->caminhao->criar($request->all());

            return new Response([
                'data' => 'Caminhao criado com sucesso.',
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

    public function update(AtualizarCaminhaoRequest $request, string $id)
    {
        try {
            $this->caminhao->atualizar($id, $request->all());

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
            $this->caminhao->deletar($id);

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
