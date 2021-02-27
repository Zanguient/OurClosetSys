<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterarTabelaPecasAdicionandoColunaTamanho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pecas', function (Blueprint $table) {
            $table->string('tamanho')->nullable();
        });
        Schema::table('movimentacoes_estoque', function (Blueprint $table) {
            $table->dropColumn('tamanho');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movimentacoes_estoque', function (Blueprint $table) {
            $table->string('tamanho')->nullable();
        });
        Schema::table('pecas', function (Blueprint $table) {
            $table->dropColumn('tamanho');
        });
    }
}
