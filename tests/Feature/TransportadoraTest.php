<?php

namespace Tests\Feature;

use App\Models\Transportadora;
use Avlima\PhpCpfCnpjGenerator\Generator;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Tests\TestCase;

class TransportadoraTest extends TestCase
{
    use WithoutMiddleware;

    public function test_index()
    {
        Transportadora::factory()->count(1)->create();

        $resultado = $this->get('api/transportadoras');

        $resultado->assertStatus(Response::HTTP_OK);
    }

    public function test_show()
    {
        $transportadora = Transportadora::factory()->create();

        $resultado = $this->get("api/transportadoras/{$transportadora->id}");

        $resultado->assertStatus(Response::HTTP_OK);
    }

    public function test_store()
    {
        $resultado = $this->post('api/transportadoras', [
            'nome' => fake()->name(),
            'cnpj' => Generator::cnpj(),
        ]);

        $resultado->assertStatus(Response::HTTP_CREATED);
    }

    public function test_update()
    {
        $transportadora = Transportadora::factory()->create();
        $request = [
            'nome' => fake()->name(),
            'cnpj' => Generator::cnpj(),
        ];

        $resultado = $this->put("api/transportadoras/{$transportadora->id}", $request);

        $resultado->assertStatus(Response::HTTP_NO_CONTENT);
    }

    public function test_destroy()
    {
        $transportadora = Transportadora::factory()->create();

        $resultado = $this->delete("api/transportadoras/{$transportadora->id}");

        $resultado->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
