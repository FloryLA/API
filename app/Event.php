<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Event extends Model
{
    use SoftDeletes;    
    protected $fillable = [
        'direccion',
        'latitud',
        'longitud',
        'titulo',
        'tipoevento',
        'descripcion',
        'fecharegistro',
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
        'zonahoraria',
         'usuario_id'
       ];

    protected $hidden=['deleted_at','created_at','updated_at'];


    public function states(){
        return $this->hasMany('App\State');
    }

}
