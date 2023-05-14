<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface CRUD
{
    public function obterTodos(): Collection;
    public function obterPor(int $id): ?Model;
    public function criar(array $request): void;
    public function atualizar(int $id, array $request): void;
    public function deletar(int $id): void;
}
