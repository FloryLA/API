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
            $table->id(); 
             //Identificadores
            $table->bigInteger('empresa_id')->nullable();
            $table->bigInteger('sucursal_id')->nullable();
            $table->bigInteger('usuario_id')->nullable();
            $table->bigInteger('supervisor_id')->nullable();
            $table->bigInteger('id_project')->unsigned()->nullable();
            //informacion
            $table->string('titulo')->nullable();
            $table->string('descripcion')->nullable(); 
            $table->string('direccion')->nullable();
            $table->decimal('latitud',10,7)->nullable();
            $table->decimal('longitud',10,7)->nullable();
            $table->string('tipoevento')->nullable();
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
            

           // $table->bigInteger('id_state')->unsigned()->nullable();
           // $table->foreign('id_state')->references('id')->on('states');

          /*  $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');*/

          
            $table->foreign('id_project')->references('id')->on('projects');

           /* $table->integer('workday_id')->unsigned();
            $table->foreign('workday_id')->references('id')->on('workdays');*/
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
