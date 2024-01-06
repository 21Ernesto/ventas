<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promo_vendidos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre_paquete');
            $table->string('telefono');
            $table->string('correo');
            $table->string('nombre');
            $table->integer('costo_real_adul');
            $table->integer('costo_real_nini');
            $table->integer('cantidad_adultos');
            $table->integer('cantidad_ninio');
            $table->date('fecha_llegada');
            $table->date('fecha_salida');
            $table->double('total');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_vendidos');
    }
};
