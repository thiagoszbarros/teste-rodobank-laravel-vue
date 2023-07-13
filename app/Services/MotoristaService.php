<?php

namespace App\Services;

use App\Interfaces\CRUD;
use App\Models\Motorista;
use Carbon\Carbon;
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
            ->select(
                'id',
                'nome',
                'cpf',
                'email'
            )
            ->paginate($offset);
    }

    public function obterPor(string $id): ?Motorista
    {
        return $this->motorista::select(
            'id',
            'nome',
            'cpf',
            'email'
        )->find($id);
    }

    public function criar(array $request): void
    {
        $request['data_nascimento'] = Carbon::createFromDate($request['data_nascimento']);
        $this->motorista::create($request);
    }

    public function atualizar(string $id, array $request): void
    {
        $request['data_nascimento'] = Carbon::createFromDate($request['data_nascimento']);
        $this->motorista::where('id', $id)->update($request);
    }

    public function deletar(string $id): void
    {
        $this->motorista::destroy(explode(',', $id));
    }
}
