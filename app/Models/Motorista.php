<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motorista extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'motorista';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nome',
        'cpf',
        'data_nascimento',
        'email',
        'transportadora_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function transportadora()
    {
        return $this->belongsTo(Transportadora::class);
    }

    public function caminhoes()
    {
        return $this->hasMany(Caminhao::class);
    }
}
