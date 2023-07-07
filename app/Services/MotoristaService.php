<?php

namespace App\Services;

use App\Interfaces\CRUD;
use App\Models\Motorista;
use Illuminate\Pagination\LengthAwarePaginator;

class MotoristaService implements CRUD
{
    public function __construct(
        private Motorista $motorista
    ) {
    }

    public function obterTodos(int $offset = null): LengthAwarePaginator
    {
        $offset = $offset ?: Motorista::count();

        return $this->motorista::with('caminhoes:id,motorista_id,placa')
            ->select('id', 'nome', 'cpf', 'email')
            ->paginate($offset);
    }

    public function obterPor(string $id): ?Motorista
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
                'transportadora_id' => $request['transportadora_id'],
            ]
        );
    }

    public function atualizar(string $id, array $request): void
    {
        $motorista = $this->motorista::find($id);
        $motorista->nome = isset($request['nome']) ? $request['nome'] : $motorista->nome;
        $motorista->cpf = isset($request['cpf']) ? $request['cpf'] : $motorista->cpf;
        $motorista->data_nascimento = isset($request['data_nascimento']) ?
            \DateTime::createFromFormat('d-m-Y', $request['data_nascimento']) :
            $motorista->data_nascimento;
        $motorista->transportadora_id = isset($request['transportadora_id']) ? $request['transportadora_id'] : $motorista->transportadora_id;
        $motorista->save();
    }

    public function deletar(string $id): void
    {
        $this->motorista::destroy(explode(',', $id));
    }
}
