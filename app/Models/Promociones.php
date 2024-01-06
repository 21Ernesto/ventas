<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Promociones extends Model
{
    use HasFactory;

    protected $table = 'promociones';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nombre_paquete',
        'descripcion_paquete',
        'costo_adulto_pro',
        'costo_ninio_pro',
        'costo_adulto',
        'costo_ninio',
        'rango_edad',
        'correo_1',
        'correo_2',
        'promocion',
        'imagen',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }
}
