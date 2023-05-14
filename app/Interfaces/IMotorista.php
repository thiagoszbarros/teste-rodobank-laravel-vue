<?php

namespace App\Interfaces;

use App\Models\Motorista;
use Illuminate\Database\Eloquent\Collection;

interface IMotorista
{
    public function obterTodos(): Collection;
    public function obterPor(int $id): ?Motorista;
    public function criar(array $motorista): void;
    public function atualizar(int $id, array $motorista): void;
    public function deletar(int $id): void;
}
