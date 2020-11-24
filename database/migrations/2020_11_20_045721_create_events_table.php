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
            $table->string('direccion');
            $table->decimal('latitud',10,7);
            $table->decimal('longitud',10,7);
            $table->string('titulo');
            $table->string('tipoevento');
            $table->string('descripcion'); 
           
            $table->date('fechainicio');
            $table->date('fechafin');
            $table->time('horainicio');
            $table->time('horafin');
            $table->date('fecharecordatorio');
            $table->time('horarecordatorio');
            $table->time('temporizador');
            $table->string('recurrente');
            $table->string('periodo');
            $table->string('url');
           // $table->string('usuario');

            /*$table->integer('state_id')->unsigned();
            $table->foreign('state_id')->references('id')->on('states');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');

            $table->integer('workday_id')->unsigned();
            $table->foreign('workday_id')->references('id')->on('workdays');*/
            $table->dateTimeTz('zonahoraria',0);
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
