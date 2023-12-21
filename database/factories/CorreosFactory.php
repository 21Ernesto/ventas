<?php

namespace Database\Factories;

use App\Models\Correos;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Correos>
 */
class CorreosFactory extends Factory
{
    protected $model = Correos::class;

    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'nombre' => $this->faker->name,
            'email' => $this->faker->email,
        ];
    }
}
