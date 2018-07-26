<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Carpeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carpeta', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->increments('id');
        $table->integer('idCongregacion')->unsigned();
        $table->integer('annio');
        $table->integer('mes');
        $table->float('vlrInicioMes', 8, 2)->default(0);
        $table->float('balance', 8, 2)->default(0);
        $table->float('obraMundial', 8, 2)->default(0);
        $table->float('totalGastos', 8, 2)->default(0);
        $table->float('resolucionSalones', 8, 2)->default(0);
        $table->float('cajaCongregacion', 8, 2)->default(0);
        $table->foreign('idCongregacion')->references('id')->on('congregacion');
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
        Schema::dropIfExists('carpeta');
    }
}
