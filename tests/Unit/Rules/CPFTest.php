<?php

namespace Tests\Unit\Rules;

use App\Rules\CPF;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

it('deve retornar true quuando cpf válido for passado', function () {
    $regra = ['cpf' => [new CPF]];
    $cpf = ['cpf' => '06806573398'];
    $tradutor = new Translator(new ArrayLoader, 'pt-br');
    $validador = (new Factory($tradutor))->make($cpf, $regra);

    $resultado = $validador->passes();

    expect($resultado)->toBeTrue();
});

it('deve retornar false quando cpf inválido for passado', function () {
    $regra = ['cpf' => [new CPF]];
    $cpf = ['cpf' => '42363644000'];
    $tradutor = new Translator(new ArrayLoader, 'pt-br');
    $validador = (new Factory($tradutor))->make($cpf, $regra);

    $resultado = $validador->passes();

    expect($resultado)->toBeFalse();
});
