<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'Nombre'
    ];
    protected $hidden=['created_at','updated_at'];
    public function events(){
        return $this->hasMany('App\Event');
    }





}
