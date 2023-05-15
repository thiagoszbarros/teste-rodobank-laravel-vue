<?php

namespace Tests\Feature;

use App\Models\Motorista;
use App\Models\Transportadora;
use Avlima\PhpCpfCnpjGenerator\Generator;
use DateInterval;
use DateTime;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Tests\TestCase;

class MotoristaTest extends TestCase
{
    use WithoutMiddleware;

    public function test_index()
    {
        Motorista::factory()->count(1)->create();

        $resultado = $this->get('api/motoristas');

        $resultado->assertStatus(Response::HTTP_OK);
    }

    public function test_show()
    {
        $motorista = Motorista::factory()->create();

        $resultado = $this->get("api/motoristas/{$motorista->id}");

        $resultado->assertStatus(Response::HTTP_OK);
    }

    public function test_store()
    {
        $resultado = $this->post('api/motoristas', [
            'nome' => fake()->name(),
            'cpf' => Generator::cpf(),
            'data_nascimento' => (new DateTime())->sub(new DateInterval('P18Y'))->format('d-m-Y'),
            'email' => fake()->email(),
            'transportadora_id' => Transportadora::factory()->create()->id,
        ]);

        $resultado->assertStatus(Response::HTTP_CREATED);
    }

    public function test_update()
    {
        $motorista = Motorista::factory()->create();
        $request = [
            'nome' => fake()->name(),
            'cpf' => Generator::cpf(),
            'data_nascimento' => (new DateTime())->sub(new DateInterval('P18Y'))->format('d-m-Y'),
            'email' => fake()->email(),
            'transportadora_id' => Transportadora::factory()->create()->id,
        ];

        $resultado = $this->put("api/motoristas/{$motorista->id}", $request);

        $resultado->assertStatus(Response::HTTP_NO_CONTENT);
    }

    public function test_destroy()
    {
        $motorista = Motorista::factory()->create();

        $resultado = $this->delete("api/motoristas/{$motorista->id}");

        $resultado->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
