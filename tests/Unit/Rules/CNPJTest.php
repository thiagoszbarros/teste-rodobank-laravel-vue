<?php

namespace Tests\Unit\Rules;

use App\Rules\CNPJ;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory as ValidationFactory;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;



class CNPJTest extends TestCase
{

    public function test_retorna_true_cnpj_valido_for_passado(): void
    {
        $regra = ['cnpj' => [new CNPJ]];
        $cnpj = ['cnpj' => '40823848000135'];
        $tradutor = new Translator(new ArrayLoader, 'pt-br');
        $validador = (new ValidationFactory($tradutor))->make($cnpj, $regra);

        $resultado = $validador->passes();

        assertTrue($resultado);
    }

    public function test_retorna_false_quando_cnpj_invalido_for_passado(): void
    {
        $regra = ['cnpj' => [new CNPJ]];
        $cnpj = ['cnpj' => '42363644000100'];
        $tradutor = new Translator(new ArrayLoader, 'pt-br');
        $validador = (new ValidationFactory($tradutor))->make($cnpj, $regra);

        $resultado = $validador->passes();

        assertFalse($resultado);
    }
}
