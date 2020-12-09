<?php

namespace App;
use App\Project;
use App\Timezone;
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
        'contacto_id',
        'titulo',
        'descripcion',
        'direccion',
        'latitud',
        'longitud',
        'tipoevento',
        'fecharegistro',
        'inicio',
        'fin',
        'recordatorio',
        'temporizador',
        'recurrente',
        'periodo',
        'url'
       ];

    protected $hidden=['deleted_at','created_at','updated_at'];


    public function project(){
        return $this->belongsTo('App\Project');
    }
    public function timezone(){
      return $this->belongsTo('App\Timezone');
  }

    
    public function getFechaInicioAttribute(){


      $fecha=$this->inicio;
      if ($fecha) {
        $splitfecha = explode(" ",$fecha);
      
        return $splitfecha[0];
        
      }
      return null;
      }
      
      public function getHoraInicioAttribute(){
         // $splithora=explode(' ',$this->fechainicio);
         $fecha=$this->inicio;
         if ($fecha) {
          $splitfecha = explode(" ",$fecha);
          return $splitfecha[1];
           
         }
         return null;
         //$splithora[1];
      }

public function getFechaFinAttribute()
{
  $fecha=$this->fin;
  if ($fecha) {
    $splitfecha = explode(" ",$fecha);
    return $splitfecha[0];
  }
  return null;
}

public function getHoraFinAttribute()
{
  $fecha=$this->fin;
  if ($fecha) {
    $splitfecha = explode(" ",$fecha);
    return $splitfecha[1];
  }
  return null;
}

public function getFechaRecordatorioAttribute()
{
  $fecha=$this->recordatorio;
  if ($fecha) {
    $splitfecha = explode(" ",$fecha);
    return $splitfecha[0];
  }
  return null;
}

public function getHoraRecordatorioAttribute()
{
  $fecha=$this->recordatorio;
  if ($fecha) {
    $splitfecha = explode(" ",$fecha);
    return $splitfecha[1];
  }
  return null;
}





}
