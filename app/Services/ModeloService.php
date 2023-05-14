<?php

namespace App\Services;

use App\Models\Modelo;
use App\Interfaces\CRUD;
use Illuminate\Database\Eloquent\Collection;

class ModeloService implements CRUD
{
    public function __construct(
        private Modelo $modelo,
    ) {
    }

    public function obterTodos(): Collection
    {
        return $this->modelo::select('id', 'nome')
            ->get();
    }

    public function obterPor(string $id): ?Modelo
    {
        return $this->modelo::select('id', 'nome')
            ->find($id);
    }

    public function criar(array $request): void
    {
        $this->modelo::create(
            [
                'nome' => $request['nome'],
            ]
        );
    }

    public function atualizar(string $id, array $request): void
    {
        $modelo = $this->modelo::find($id);
        $modelo->nome = isset($request['nome']) ? $request['nome'] : $modelo->nome;
        $modelo->save();
    }

    public function deletar(string $id): void
    {
        $this->modelo::whereIn('id', explode(',', $id))->delete();
    }
}
