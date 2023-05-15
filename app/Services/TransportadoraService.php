<?php

namespace App\Services;

use App\Interfaces\CRUD;
use App\Models\Transportadora;
use Illuminate\Pagination\LengthAwarePaginator;

class TransportadoraService implements CRUD
{
    public function __construct(
        private Transportadora $transportadora,
    ) {
    }

    public function obterTodos(int $offset = null): LengthAwarePaginator
    {
        $offset = isset($offset) ? $offset : Transportadora::count();

        return $this->transportadora::with('motoristas:id,transportadora_id')
            ->select('id', 'nome', 'cnpj', 'status')
            ->paginate($offset);
    }

    public function obterPor(string $id): ?Transportadora
    {
        return $this->transportadora::select('nome', 'cnpj', 'status')
            ->find($id);
    }

    public function criar(array $request): void
    {

        $this->transportadora::create(
            [
                'nome' => $request['nome'],
                'cnpj' => $request['cnpj'],
            ]
        );
    }

    public function atualizar(string $id, array $request): void
    {
        $transportadora = $this->transportadora::find($id);
        $transportadora->nome = isset($request['nome']) ? $request['nome'] : $transportadora->nome;
        $transportadora->cnpj = isset($request['cnpj']) ? $request['cnpj'] : $transportadora->cnpj;
        $transportadora->status = isset($request['status']) ? $request['status'] : $transportadora->status;
        $transportadora->save();
    }

    public function deletar(string $id): void
    {
        $this->transportadora::whereIn('id', explode(',', $id))->delete();
    }
}
