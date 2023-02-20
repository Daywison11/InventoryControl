<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Items', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nome');
            $table->string('tipo');
            $table->float('valor-un-compra');
            $table->float('valor-un-venda');
            $table->bigInteger('estoque-gerado');
            $table->bigInteger('estoque-disponivel');
            $table->bigInteger('entradas');
            $table->bigInteger('saidas');
            $table->bigInteger('perca');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
