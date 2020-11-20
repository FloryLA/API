<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Direccion');
            $table->string('latitud');
            $table->string('longitud');

            $table->string('Titulo');
            $table->string('TipoEvento');
            $table->string('Descripcion');
            $table->date('FechaInicio');
            $table->date('FechaFin');
            $table->time('HoraInicio');
            $table->time('HoraFin');
            $table->date('FechaRecordatorio');
            $table->time('HoraRecordatorio');
            $table->string('Recurrente',1);
            $table->string('Periodo');
            $table->string('Url');
            $table->time('temporizador');


            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');

            $table->integer('state_id')->unsigned();
            $table->foreign('state_id')->references('id')->on('states');

            $table->integer('workday_id')->unsigned();
            $table->foreign('workday_id')->references('id')->on('workdays');

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
        Schema::dropIfExists('events');
    }
}
