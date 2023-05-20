<?php

namespace Tests\Unit\Rules;

use App\Rules\CNPJ;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

it('deve retornar true cnpj valido for passado', function () {
    $regra = ['cnpj' => [new CNPJ]];
    $cnpj = ['cnpj' => '40823848000135'];
    $tradutor = new Translator(new ArrayLoader, 'pt-br');
    $validador = (new Factory($tradutor))->make($cnpj, $regra);

    $resultado = $validador->passes();

    expect($resultado)->toBeTrue();
});

it('deve retornar false quando cnpj invalido for passado', function () {
    $regra = ['cnpj' => [new CNPJ]];
    $cnpj = ['cnpj' => '42363644000100'];
    $tradutor = new Translator(new ArrayLoader, 'pt-br');
    $validador = (new Factory($tradutor))->make($cnpj, $regra);

    $resultado = $validador->passes();

    expect($resultado)->toBeFalse();
});
