<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyecto extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	"nombre",
		"descripcion"
    ];
    protected $hidden =[
    	"created_at","updated_at","deleted_at"
    ];

    public function agendas()
    {
    	return $this->hasMany("App\Agenda");
    }

}
