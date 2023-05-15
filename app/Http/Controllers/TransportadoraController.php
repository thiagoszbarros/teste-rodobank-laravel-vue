<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtualizarTransportadoraRequest;
use App\Http\Requests\CriarTransportadoraRequest;
use App\Interfaces\CRUD;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransportadoraController extends Controller
{
    public function __construct(
        private readonly CRUD $transportadora
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        try {
            return new JsonResponse(
                $this->transportadora->obterTodos($request->query('offset')),
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return new JsonResponse(
                $e->getMessage(),
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            return new JsonResponse(
                $this->transportadora->obterPor($id),
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return new JsonResponse(
                $e->getMessage(),
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function store(CriarTransportadoraRequest $request): JsonResponse
    {
        try {
            $this->transportadora->criar($request->all());

            return new JsonResponse(
                'Transportadora criada com sucesso.',
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return new JsonResponse(
                $e->getMessage(),
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function update(AtualizarTransportadoraRequest $request, string $id): JsonResponse
    {
        try {
            $this->transportadora->atualizar($id, $request->all());

            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new JsonResponse(
                $e->getMessage(),
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $this->transportadora->deletar($id);

            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new JsonResponse(
                $e->getMessage(),
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
