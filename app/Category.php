<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'Nombre', 'Descripcion',
    ];
    public function project(){
        return $this->belongsTo('App\Project');
    }

}
