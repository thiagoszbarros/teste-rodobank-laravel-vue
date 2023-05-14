<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transportadora extends Model
{
    use HasFactory;

    protected $table = 'transportadora';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nome',
        'cnpj',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
