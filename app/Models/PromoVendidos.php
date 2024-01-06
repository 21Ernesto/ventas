<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PromoVendidos extends Model
{
    use HasFactory;

    protected $table = 'promo_vendidos';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nombre_paquete',
        'telefono',
        'nombre',
        'correo',
        'costo_real_adul',
        'costo_real_nini',
        'cantidad_adultos',
        'cantidad_ninio',
        'fecha_llegada',
        'fecha_salida',
        'total'
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }
}
