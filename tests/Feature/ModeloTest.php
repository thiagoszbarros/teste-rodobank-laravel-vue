<?php

namespace Tests\Feature;

use App\Models\Modelo;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Tests\TestCase;

class ModeloTest extends TestCase
{
    use WithoutMiddleware;

    public function test_index()
    {
        Modelo::factory()->count(1)->create();

        $resultado = $this->get('api/modelos');

        $resultado->assertStatus(Response::HTTP_OK);
    }

    public function test_show()
    {
        $motorista = Modelo::factory()->create();

        $resultado = $this->get("api/modelos/{$motorista->id}");

        $resultado->assertStatus(Response::HTTP_OK);
    }

    public function test_store()
    {
        $resultado = $this->post('api/modelos', [
            'nome' => fake()->word(),
        ]);

        $resultado->assertStatus(Response::HTTP_CREATED);
    }

    public function test_update()
    {
        $motorista = Modelo::factory()->create();

        $resultado = $this->put("api/modelos/{$motorista->id}", [
            'nome' => fake()->word(),
        ]);

        $resultado->assertStatus(Response::HTTP_NO_CONTENT);
    }

    public function test_destroy()
    {
        $motorista = Modelo::factory()->create();

        $resultado = $this->delete("api/modelos/{$motorista->id}");

        $resultado->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
