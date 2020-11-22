<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function state(){
        return $this->belongsTo('App\Project');
    }

}
