<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_vendas', function (Blueprint $table) {
            $table->bigInteger('produtos_idprodutos')->unsigned();
            $table->foreign('produtos_idprodutos')->references('id')->on('produtos');
            $table->bigInteger('vendas_idvendas')->unsigned();
            $table->foreign('vendas_idvendas')->references('id')->on('vendas');
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
        Schema::dropIfExists('lista_vendas');
    }
}
