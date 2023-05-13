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
        Schema::create('modelo', function (Blueprint $tabela) {
            $tabela->id();
            $tabela->string('nome', 50)
                ->nullable(false)
                ->comment('Modelo de caminhão');
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
        DB::statement('DROP TABLE IF EXISTS modelo CASCADE');
    }
};
