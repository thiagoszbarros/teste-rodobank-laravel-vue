<?php

namespace Tests\Unit\Rules;

use App\Rules\CPF;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory as ValidationFactory;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;
use PHPUnit\Framework\TestCase;

class CPFTest extends TestCase
{
    public function test_retorna_true_cpf_valido_for_passado(): void
    {
        $regra = ['cpf' => [new CPF]];
        $cpf = ['cpf' => '06806573398'];
        $tradutor = new Translator(new ArrayLoader, 'pt-br');
        $validador = (new ValidationFactory($tradutor))->make($cpf, $regra);

        $resultado = $validador->passes();

        assertTrue($resultado);
    }

    public function test_retorna_false_quando_cpf_invalido_for_passado(): void
    {
        $regra = ['cpf' => [new CPF]];
        $cpf = ['cpf' => '42363644000'];
        $tradutor = new Translator(new ArrayLoader, 'pt-br');
        $validador = (new ValidationFactory($tradutor))->make($cpf, $regra);

        $resultado = $validador->passes();

        assertFalse($resultado);
    }
}
