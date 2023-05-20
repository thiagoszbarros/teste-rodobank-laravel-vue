<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtualizarModeloRequest;
use App\Http\Requests\CriarModeloRequest;
use App\Http\Requests\PaginacaoRequest;
use App\Interfaces\CRUD;
use Illuminate\Http\JsonResponse;

class ModeloController extends Controller
{
    public function __construct(
        private CRUD $modelo
    ) {
    }

    public function index(PaginacaoRequest $request): JsonResponse
    {
        try {
            return new JsonResponse(
                $this->modelo->obterTodos($request->query('offset')),
                JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(
                $e->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            return new JsonResponse(
                $this->modelo->obterPor($id),
                JsonResponse::HTTP_OK);
        } catch (\Exception $e) {

            return new JsonResponse(
                $e->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function store(CriarModeloRequest $request): JsonResponse
    {
        try {
            $this->modelo->criar($request->all());

            return new JsonResponse(
                'Modelo criado com sucesso.',
                JsonResponse::HTTP_CREATED
            );
        } catch (\Exception $e) {

            return new JsonResponse(
                $e->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function update(AtualizarModeloRequest $request, string $id): JsonResponse
    {
        try {
            $this->modelo->atualizar($id, $request->all());

            return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
        } catch (\Exception $e) {

            return new JsonResponse(
                $e->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $this->modelo->deletar($id);

            return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new JsonResponse(
                $e->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }
}
