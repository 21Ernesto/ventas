<?php

namespace Database\Seeders;

use App\Models\Correos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  \Illuminate\Database\Eloquent\Factories\Factory;

class CorreosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $cantidadRegistros = 10;

        Correos::factory($cantidadRegistros)->create();
    }
}
