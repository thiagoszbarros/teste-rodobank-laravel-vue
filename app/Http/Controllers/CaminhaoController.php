<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtualizarCaminhaoRequest;
use App\Http\Requests\CriarCaminhaoRequest;
use App\Interfaces\CRUD;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CaminhaoController extends Controller
{
    public function __construct(
        private CRUD $caminhao
    ) {
    }

    public function index(Request $request)
    {
        try {
            return new JsonResponse(
                $this->caminhao->obterTodos($request->query('offset')),
                JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(
                $e->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function show(string $id)
    {
        try {
            return new JsonResponse(
                $this->caminhao->obterPor($id),
                JsonResponse::HTTP_OK);
        } catch (\Exception $e) {

            return new JsonResponse(
                $e->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function store(CriarCaminhaoRequest $request)
    {
        try {
            $this->caminhao->criar($request->all());

            return new JsonResponse(
                'Caminhao criado com sucesso.',
                JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {

            return new JsonResponse(
                $e->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function update(AtualizarCaminhaoRequest $request, string $id)
    {
        try {
            $this->caminhao->atualizar($id, $request->all());

            return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
        } catch (\Exception $e) {

            return new JsonResponse(
                $e->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->caminhao->deletar($id);

            return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new JsonResponse(
                $e->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }
}
