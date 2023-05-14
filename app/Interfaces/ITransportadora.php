<?php

namespace App\Interfaces;

use App\Models\Transportadora;
use Illuminate\Database\Eloquent\Collection;

interface ITransportadora
{
    public function obterTodos(): Collection;
    public function obterPor(int $id): ?Transportadora;
    public function criar(array $transportadora): void;
    public function atualizar(int $id, array $transportadora): void;
    public function deletar(int $id): void;
}
