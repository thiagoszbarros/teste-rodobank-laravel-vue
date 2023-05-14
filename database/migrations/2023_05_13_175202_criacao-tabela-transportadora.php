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
        Schema::create('transportadora', function (Blueprint $tabela) {
            $tabela->id();
            $tabela->string('nome', 100)
                ->nullable(false)
                ->comment('Nome da transportadora');
            $tabela->string('cnpj', 14)
                ->nullable(false)->unique()
                ->comment('CNPJ da transportadora');
            $tabela->tinyinteger('status')
                ->nullable(false)
                ->default(1)
                ->comment('Status da transportadora: ativado => 1, desativado => 0');
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
        DB::statement('DROP TABLE IF EXISTS transportadora CASCADE');
    }
};
