<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Motorista extends Model
{
    use HasFactory;

    protected $table = 'motorista';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nome',
        'cpf',
        'data_nascimento',
        'email',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
