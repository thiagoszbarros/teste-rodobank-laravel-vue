<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transportadora extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function motoristas()
    {
        return $this->hasMany(Motorista::class);
    }

    public function caminhoes()
    {
        return $this->hasMany(Caminhao::class);
    }
}
