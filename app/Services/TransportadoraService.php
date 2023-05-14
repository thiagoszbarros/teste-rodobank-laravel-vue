<?php

namespace App\Services;

use App\Enum\TransportadoraStatus;
use App\Models\Transportadora;
use App\Interfaces\ITransportadora;
use Illuminate\Database\Eloquent\Collection;

class TransportadoraService implements ITransportadora
{
    public function __construct(
        private Transportadora $transportadora,
    ) {
    }

    public function obterTodos(): Collection
    {
        return $this->transportadora::select('nome', 'cnpj', 'status')
            ->get();
    }

    public function obterPor(int $id): ?Transportadora
    {
        return $this->transportadora::select('nome', 'cnpj', 'status')
            ->find($id);
    }

    public function criar(array $transportadora): void
    {

        $this->transportadora::create(
            [
                'nome' => $transportadora['nome'],
                'cnpj' => $transportadora['cnpj'],
                'status' => TransportadoraStatus::ATIVADO->status(),
            ]
        );
    }

    public function atualizar(int $id, array $transportadora): void
    {
        $this->transportadora::whereId($id)->update(
            [
                'nome' => $transportadora['nome'],
                'status' => $transportadora['status'],
            ]
        );
    }

    public function deletar(int $id): void
    {
        $this->transportadora::whereId($id)->delete();
    }
}
