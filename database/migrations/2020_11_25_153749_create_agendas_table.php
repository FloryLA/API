<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            // Identificador
            $table->bigInteger('empresa_id')->nullable();
            $table->bigInteger('sucursal_id')->nullable();
            $table->bigInteger('usuario_id')->nullable();
            $table->bigInteger('proyecto_id')->unsigned()->nullable();
            $table->bigInteger('supervisor_id')->nullable();

            // Informacion
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->text('direccion')->nullable();
            $table->decimal('latitud',10,7)->nullable();
            $table->decimal('longitud',10,7)->nullable();
            $table->string('tipoevento')->nullable();
            $table->date('fechainicio')->nullable();
            $table->date('fecharegistro')->nullable();
            $table->date('fechafin')->nullable();
            $table->date('fecharecordatorio')->nullable();
            $table->time('horarecordatorio')->nullable();
            $table->time('temporizador')->nullable();
            $table->string('recurrente')->nullable();
            $table->string('periodo')->nullable();
            
            $table->string('url')->nullable();

            $table->timestamps();
            $table->softDeletes();
            
            //$table->integer('proyecto_id')->unsigned();
            $table->foreign('proyecto_id')->references('id')->on('proyectos');
        });
    }

    /**      
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendas');
    }
}
