<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  //  use SoftDeletes;    
    protected $fillable = [
        'direccion',
        'latitud',
        'longitud',
        'titulo',
        'tipoevento',
        'descripcion',
        'fechainicio',
        'fechafin',
        'horainicio',
        'horafin',
        'fecharecordatorio',
        'horarecordatorio',
        'recurrente',
        'periodo',
        'url',
        'temporizador',
        'zonahoraria'
       /*'usuario'*/
       ];

    protected $hidden=['created_at','updated_at'];


    public function states(){
        return $this->hasMany('App\State');
    }

}
