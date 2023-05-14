<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('motorista', function (Blueprint $tabela) {
            $tabela->id();
            $tabela->string('nome', 100)
                ->nullable(false)
                ->comment('Nome do motorista');
            $tabela->string('cpf', 11)->unique()
                ->nullable(false)
                ->comment('CPF da motorista');
            $tabela->dateTime('data_nascimento')
                ->nullable(false)
                ->comment('Data do nascimento do motorista');
            $tabela->string('email', 100)
                ->nullable(false)
                ->comment('Email do motorista');
            $tabela->dateTime('created_at');
            $tabela->dateTime('updated_at');
            $tabela->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TABLE IF EXISTS motorista CASCADE');
    }
};
