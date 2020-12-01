<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workdays', function (Blueprint $table) {
            $table->id();
            $table->string('DiaInicio',1);
            $table->string('DiaFin',1);
            $table->date('FechaEntrada');
            $table->time('HoraEntrada');
            $table->time('InicioReceso');
            $table->time('FinReceso');
            $table->date('FechaSalida');
            $table->time('HoraSalida');
            $table->softDeletes();
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
        Schema::dropIfExists('workdays');
    }
}
