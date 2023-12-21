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
        Schema::create('promociones', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre_paquete');
            $table->text('descripcion_paquete');
            // $table->integer('catindad_dias');
            $table->double('costo_adulto');
            $table->double('costo_ninio');
            $table->string('imagen')->nullable();
            $table->integer('promocion')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promociones');
    }
};
