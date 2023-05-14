<?php

namespace App\Http\Controllers;

use App\Interfaces\CRUD;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ModeloController extends Controller
{
    public function __construct(
        private CRUD $modelo
    ) {
    }

    public function index()
    {
        try {
            return new Response([
                'data' => $this->modelo->obterTodos(),
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
                'data' => $this->modelo->obterPor($id),
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

    public function store(Request $request)
    {
        try {
            $this->modelo->criar($request->all());

            return new Response([
                'data' => 'modelo criado com sucesso.',
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
            $this->modelo->atualizar($id, $request->all());

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
            $this->modelo->deletar($id);

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
