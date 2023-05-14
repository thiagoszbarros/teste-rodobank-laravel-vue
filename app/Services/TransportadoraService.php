<?php

namespace App\Services;

use App\Interfaces\CRUD;
use App\Models\Transportadora;
use Illuminate\Database\Eloquent\Collection;

class TransportadoraService implements CRUD
{
    public function __construct(
        private Transportadora $transportadora,
    ) {
    }

    public function obterTodos(): Collection
    {
        return $this->transportadora::select('id', 'nome', 'cnpj', 'status')
            ->get();
    }

    public function obterPor(int $id): ?Transportadora
    {
        return $this->transportadora::select('nome', 'cnpj', 'status')
            ->find($id);
    }

    public function criar(array $request): void
    {

        $this->transportadora::create($request);
    }

    public function atualizar(int $id, array $request): void
    {
        $transportadora = $this->transportadora::find($id);
        $transportadora->nome = isset($request['nome']) ? $request['nome'] : $transportadora->nome;
        $transportadora->cnpj = isset($request['cnpj']) ? $request['cnpj'] : $transportadora->cnpj;
        $transportadora->status = isset($request['status']) ? $request['status'] : $transportadora->status;
        $transportadora->save();
    }

    public function deletar(int $id): void
    {
        $this->transportadora::whereId($id)->delete();
    }
}
