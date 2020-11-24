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
            
            $table->string('direccion')->nullable();
            $table->decimal('latitud',10,7)->nullable();
            $table->decimal('longitud',10,7)->nullable();
            $table->string('titulo')->nullable();
            $table->string('tipoevento')->nullable();
            $table->string('descripcion')->nullable(); 
            $table->date('fecharegistro')->nullable();
            $table->date('fechainicio')->nullable();
            $table->date('fechafin')->nullable();
            $table->time('horainicio')->nullable();
            $table->time('horafin')->nullable();
            $table->date('fecharecordatorio')->nullable();
            $table->time('horarecordatorio')->nullable();
            $table->time('temporizador')->nullable();
            $table->string('recurrente')->nullable();
            $table->string('periodo')->nullable();
            $table->string('url')->nullable();
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
            $table->integer('usuario_id')->unsigned()->nullable();
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
        Schema::dropIfExists('events');
    }
}
