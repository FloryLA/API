<?php

namespace App;
use Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Event extends Model
{
    use SoftDeletes;    
    protected $fillable = [
       'empresa_id',
       'sucursal_id',
       'usuario_id',
        'supervisor_id',
        'project_id',
        'titulo',
        'descripcion',
        'direccion',
        'latitud',
        'longitud',
        'tipoevento',
        'fecharegistro',
        'fechainicio',
        'fechafin',
        'horainicio',
        'horafin',
        'fecharecordatorio',
        'horarecordatorio',
        'temporizador',
        'recurrente',
        'periodo',
        'url'
       ];

    protected $hidden=['deleted_at','created_at','updated_at'];


    public function project(){
        return $this->belongsTo('App\Project');
    }


}
