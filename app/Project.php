<?php

namespace App;
use Event;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['Nombre', 'Descripcion' ];
    protected $hidden=['created_at','updated_at'];

    public function events(){
        return $this->hasMany('App\Event');
    }
    
}
