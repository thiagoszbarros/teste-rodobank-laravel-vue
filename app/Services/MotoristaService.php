<?php

namespace App\Services;

use App\Interfaces\CRUD;
use App\Models\Motorista;
use Illuminate\Database\Eloquent\Collection;

class MotoristaService implements CRUD
{
    public function __construct(
        private Motorista $motorista
    ) {
    }
    public function obterTodos(): Collection
    {
        return $this->motorista::select('id', 'nome', 'cpf', 'email')->get();
    }

    public function obterPor(int $id): ?Motorista
    {
        return $this->motorista::select('id', 'nome', 'cpf', 'email')->find($id);
    }

    public function criar(array $request): void
    {
        $this->motorista::create(
            [
                'nome' => $request['nome'],
                'cpf' => $request['cpf'],
                'data_nascimento' => \DateTime::createFromFormat('d-m-Y', $request['data_nascimento']),
                'email' => $request['email'],
            ]
        );
    }

    public function atualizar(int $id, array $request): void
    {
        $motorista = $this->motorista::find($id);
        $motorista->nome = isset($request['nome']) ? $request['nome'] : $motorista->nome;
        $motorista->cpf = isset($request['cpf']) ? $request['cpf'] : $motorista->cpf;
        $motorista->data_nascimento = isset($request['data_nascimento']) ?
            \DateTime::createFromFormat('d-m-Y', $motorista['data_nascimento']) :
            $motorista->data_nascimento;
        $motorista->save();
    }

    public function deletar(int $id): void
    {
        $this->motorista::whereId($id)
            ->delete();
    }
}
