<?php

namespace Database\Factories;

use App\Models\Transportadora;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Motorista>
 */
class MotoristaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'cpf' => fake()->numerify('###########'),
            'data_nascimento' => fake()->dateTimeBetween('-80 years', '-18 years'),
            'email' => fake()->email(),
            'transportadora_id' => Transportadora::factory(),
        ];
    }
}
