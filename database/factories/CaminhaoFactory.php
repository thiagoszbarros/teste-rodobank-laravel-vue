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
        $placa = '';

        for ($i = 0; $i < 3; $i++) {
            $placa .= chr(rand(65, 90));
        }
        $placa .= '-';
        $placa .= strval(rand(0, 9));
        $placa .= chr(rand(65, 90));
        for ($i = 0; $i < 2; $i++) {
            $placa .= strval(rand(0, 9));
        }

        return $placa;
    }
}
