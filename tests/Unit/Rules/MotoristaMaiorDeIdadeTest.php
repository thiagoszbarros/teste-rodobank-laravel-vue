<?php

namespace Tests\Feature\Rules;

use App\Rules\MotoristaMaiorDeIdade;
use DateInterval;
use DateTime;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

it('deve retornar true data de nascimento de motorista maior de idade valida for passada', function () {
    $dataNascimento = (new DateTime())->sub(new DateInterval('P18Y'));
    $dataNascimentoFormatada = $dataNascimento->format('d-m-Y');
    $regra = ['motorista_maior_de_idade' => [new MotoristaMaiorDeIdade]];
    $motorista_maior_de_idade = ['motorista_maior_de_idade' => $dataNascimentoFormatada];
    $tradutor = new Translator(new ArrayLoader, 'pt-br');
    $validador = (new Factory($tradutor))->make($motorista_maior_de_idade, $regra);

    $resultado = $validador->passes();

    expect($resultado)->toBeTrue();
});

it('deve retornar false quando data de nascimento de motorista maior de idade invalida for passada', function () {
    $dataNascimento = (new DateTime())->sub(new DateInterval('P17Y'));
    $dataNascimentoFormatada = $dataNascimento->format('d-m-Y');
    $regra = ['motorista_maior_de_idade' => [new MotoristaMaiorDeIdade]];
    $motorista_maior_de_idade = ['motorista_maior_de_idade' => $dataNascimentoFormatada];
    $tradutor = new Translator(new ArrayLoader, 'pt-br');
    $validador = (new Factory($tradutor))->make($motorista_maior_de_idade, $regra);

    $resultado = $validador->passes();

    expect($resultado)->toBeFalse();
});
