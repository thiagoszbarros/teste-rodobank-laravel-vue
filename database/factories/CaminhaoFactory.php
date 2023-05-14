<?php

namespace Database\Factories;

use App\Models\Modelo;
use App\Models\Motorista;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Caminhao>
 */
class CaminhaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {

        return [
            'placa' => CaminhaoFactory::placa(),
            'cor' => fake()->colorName,
            'modelo_id' => Modelo::factory(),
            'motorista_id' => Motorista::factory(),
        ];
    }

    private static function placa(): string
    {
        return
            chr(rand(65, 90)) .
            chr(rand(65, 90)) .
            chr(rand(65, 90)) .
            '-' .
            strval(rand(0, 9)) .
            chr(rand(65, 90)) .
            strval(rand(0, 9)) .
            strval(rand(0, 9));
    }
}
