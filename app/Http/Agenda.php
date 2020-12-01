<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    //
	use SoftDeletes;

	protected $fillable=[

		'empresa_id',
		'sucursal_id',
		'usuario_id',
		'proyecto_id',
		'supervisor_id',

		'titulo',
		'descripcion',
		'direccion',
		'latitud',
		'longitud',
		'tipoevento',
		'fechainicio',
		'fecharegistro',
		'fechafin',
		'fecharecordatorio',
		'horarecordatorio',
		'temporizador',
		'recurrente',
		'periodo',
		'url'
	];

	protected $hidden =[
    	"created_at","updated_at","deleted_at"
    ];

    public function proyecto()
    {
    	return $this->belongsTo("App\Proyecto");
    }

}
