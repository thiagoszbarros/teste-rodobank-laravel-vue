<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('caminhao', function (Blueprint $tabela) {
            $tabela->id();
            $tabela->string('placa', 8)
                ->nullable(false)
                ->comment('Placa do caminhão');
            $tabela->string('cor', 50)
                ->nullable(false)
                ->comment('Cor do caminhão');
            $tabela->biginteger('modelo_id')
                ->nullable(false)
                ->comment('Modelo do caminhão');
            $tabela->foreign('modelo_id')
                ->references('id')
                ->on('modelo');
            $tabela->biginteger('motorista_id')
                ->nullable(false)
                ->comment('Motorista do caminhão');
            $tabela->foreign('motorista_id')
                ->references('id')
                ->on('motorista');
            $tabela->biginteger('transportadora_id')
                ->nullable(false)
                ->comment('Transportadora dona do caminhão');
            $tabela->foreign('transportadora_id')
                ->references('id')
                ->on('transportadora');
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
        DB::statement('DROP TABLE IF EXISTS caminhao CASCADE');
    }
};
