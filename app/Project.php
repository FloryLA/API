<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['Nombre', 'Descripcion' ];
    protected $hidden=['created_at','updated_at'];

    public function categories(){
        return $this->hasMany('App\Category');
    }
}
