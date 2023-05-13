<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Caminhao extends Model
{
    use HasFactory;

    protected $table = 'modelo';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'placa',
        'cor',
        'modelo_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function motorista(): BelongsTo
    {
        return $this->belongsTo(Motorista::class, 'motorista_id', 'id');
    }

    public function modelo(): HasOne
    {
        return $this->hasOne(Modelo::class, 'modelo_id');
    }
}
