<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promociones>
 */
class PromocionesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'nombre_paquete' => $this->faker->word,
            'descripcion_paquete' => $this->faker->sentence,
            // 'catindad_dias' => $this->faker->numberBetween(1, 10),
            'costo_adulto' => $this->faker->randomFloat(2, 10, 100),
            'costo_ninio' => $this->faker->randomFloat(2, 5, 50),
            'promocion' => $this->faker->boolean(50),
        ];
    }
}
