<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtualizarMotoristaRequest;
use App\Http\Requests\CriarMotoristaRequest;
use App\Http\Requests\PaginacaoRequest;
use App\Interfaces\CRUD;
use Illuminate\Http\JsonResponse;

class MotoristaController extends Controller
{
    public function __construct(
        private CRUD $motorista
    ) {
    }

    public function index(PaginacaoRequest $request): JsonResponse
    {
        try {
            return new JsonResponse(
                $this->motorista->obterTodos($request->query('offset')),
                JsonResponse::HTTP_OK
            );
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
                $this->motorista->obterPor($id),
                JsonResponse::HTTP_OK
            );
        } catch (\Exception $e) {

            return new JsonResponse(
                $e->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function store(CriarMotoristaRequest $request): JsonResponse
    {
        try {
            $this->motorista->criar($request->all());

            return new JsonResponse(
                'Motorista criado com sucesso.',
                JsonResponse::HTTP_CREATED
            );
        } catch (\Exception $e) {

            return new JsonResponse(
                $e->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function update(AtualizarMotoristaRequest $request, string $id): JsonResponse
    {
        try {
            $this->motorista->atualizar($id, $request->all());

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
            $this->motorista->deletar($id);

            return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new JsonResponse(
                $e->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }
}
