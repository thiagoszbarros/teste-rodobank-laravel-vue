<?php

namespace App\Rules;

use Closure;
use DateTime;
use Illuminate\Contracts\Validation\ValidationRule;

class MotoristaMaiorDeIdade implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $dataNascimento = new DateTime($value);
        $hoje = new DateTime();
        $idade = $hoje->diff($dataNascimento)->y;
        if ($idade < 18) {
            $fail('O campo :attribute não é uma data de nascimento válida para motorista maior de idade.');
        }
    }
}
