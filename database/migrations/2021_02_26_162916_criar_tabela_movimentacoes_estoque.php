<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaMovimentacoesEstoque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentacoes_estoque', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo');
            $table->integer('responsavel_id')->unsigned();
            $table->foreign('responsavel_id')->references('id')->on('usuarios');
            $table->integer('peca_id')->unsigned();
            $table->foreign('peca_id')->references('id')->on('pecas');
            $table->integer('quantidade', false, true);
            $table->string('tamanho');
            $table->timestamps();
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
            $table->dropForeign('movimentacoes_estoque_responsavel_id_foreign');
            $table->dropForeign('movimentacoes_estoque_peca_id_foreign');
        });
        Schema::dropIfExists('movimentacoes_estoque');
    }
}
