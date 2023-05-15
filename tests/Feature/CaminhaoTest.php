<?php

namespace Tests\Feature;

use App\Models\Caminhao;
use App\Models\Modelo;
use App\Models\Motorista;
use App\Models\Transportadora;
use Database\Factories\CaminhaoFactory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Tests\TestCase;

class CaminhaoTest extends TestCase
{
    use WithoutMiddleware;

    public function test_index()
    {
        Caminhao::factory()->count(1)->create();

        $resultado = $this->get('api/caminhoes');

        $resultado->assertStatus(Response::HTTP_OK);
    }

    public function test_show()
    {
        $caminhao = Caminhao::factory()->create();

        $resultado = $this->get("api/caminhoes/{$caminhao->id}");

        $resultado->assertStatus(Response::HTTP_OK);
    }

    public function test_store()
    {
        $resultado = $this->post('api/caminhoes', [
            'placa' => CaminhaoFactory::placa(),
            'motorista_id' => Motorista::factory()->create()->id,
            'modelo_id' => Modelo::factory()->create()->id,
            'cor' => fake()->colorName(),
            'transportadora_id' => Transportadora::factory()->create()->id,
        ]);

        $resultado->assertStatus(Response::HTTP_CREATED);
    }

    public function test_update()
    {
        $caminhao = Caminhao::factory()->create();
        $resultado = $this->put("api/caminhoes/{$caminhao->id}", [
            'placa' => CaminhaoFactory::placa(),
            'motorista_id' => Motorista::factory()->create()->id,
            'modelo_id' => Modelo::factory()->create()->id,
            'cor' => fake()->colorName(),
            'transportadora_id' => Transportadora::factory()->create()->id,
        ]);

        $resultado->assertStatus(Response::HTTP_NO_CONTENT);
    }

    public function test_destroy()
    {
        $caminhao = Caminhao::factory()->create();

        $resultado = $this->delete("api/caminhoes/{$caminhao->id}");

        $resultado->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
