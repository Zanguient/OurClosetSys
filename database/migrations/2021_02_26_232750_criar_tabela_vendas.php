<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('peca_id')->unsigned();
            $table->foreign('peca_id')->references('id')->on('pecas');
            $table->integer('responsavel_id')->unsigned();
            $table->foreign('responsavel_id')->references('id')->on('usuarios');
            $table->integer('quantidade', false, true);
            $table->double('valor', 12, 2);
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
        Schema::table('vendas', function (Blueprint $table) {
            $table->dropForeign('vendas_peca_id_foreign');
            $table->dropForeign('vendas_responsavel_id_foreign');
        });
        Schema::dropIfExists('vendas');
    }
}
