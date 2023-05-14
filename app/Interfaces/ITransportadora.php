<?php

namespace App\Interfaces;

use App\Models\Transportadora;
use Illuminate\Database\Eloquent\Collection;

interface ITransportadora
{
    public function obterTodos(): Collection;
    public function obterPor(int $id): ?Transportadora;
    public function criar(array $request): void;
    public function atualizar(int $id, array $request): void;
    public function deletar(int $id): void;
}
