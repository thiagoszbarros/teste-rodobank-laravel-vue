<?php

namespace Tests\Feature\Rules;

use DateTime;
use DateInterval;
use PHPUnit\Framework\TestCase;
use App\Rules\MotoristaMaiorDeIdade;
use Illuminate\Translation\Translator;

use Illuminate\Translation\ArrayLoader;
use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\assertFalse;
use Illuminate\Validation\Factory as ValidationFactory;

class MotoristaMaiorDeIdadeTest extends TestCase
{
    public function test_retorna_true_data_nascimento_de_motorista_maior_de_idade_valida_for_passada(): void
    {
        $dataNascimento = (new DateTime())->sub(new DateInterval('P18Y'));
        $dataNascimentoFormatada = $dataNascimento->format('d-m-Y');
        $regra = ['motorista_maior_de_idade' => [new MotoristaMaiorDeIdade]];
        $motorista_maior_de_idade = ['motorista_maior_de_idade' => $dataNascimentoFormatada];
        $tradutor = new Translator(new ArrayLoader, 'pt-br');
        $validador = (new ValidationFactory($tradutor))->make($motorista_maior_de_idade, $regra);

        $resultado = $validador->passes();

        assertTrue($resultado);
    }

    public function test_retorna_false_quando_data_nascimento_de_motorista_maior_de_idade_invalida_for_passada(): void
    {
        $dataNascimento = (new DateTime())->sub(new DateInterval('P17Y'));
        $dataNascimentoFormatada = $dataNascimento->format('d-m-Y');
        $regra = ['motorista_maior_de_idade' => [new MotoristaMaiorDeIdade]];
        $motorista_maior_de_idade = ['motorista_maior_de_idade' => $dataNascimentoFormatada];
        $tradutor = new Translator(new ArrayLoader, 'pt-br');
        $validador = (new ValidationFactory($tradutor))->make($motorista_maior_de_idade, $regra);

        $resultado = $validador->passes();

        assertFalse($resultado);
    }
}
