<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caminhao extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'caminhao';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'placa',
        'cor',
        'modelo_id',
        'motorista_id',
        'transportadora_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function transportadora(): BelongsTo
    {
        return $this->belongsTo(Transportadora::class);
    }

    public function motorista(): BelongsTo
    {
        return $this->belongsTo(Motorista::class);
    }

    public function modelo(): HasOne
    {
        return $this->hasOne(Modelo::class);
    }
}
