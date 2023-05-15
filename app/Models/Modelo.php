<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modelo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'modelo';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nome',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
