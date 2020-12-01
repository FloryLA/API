<?php

namespace App\Http\Controllers;

use App\Agenda;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    //

    public function store(Request $request)
    {
    	$request->validate([
    		'empresa_id' => "nullable|numeric",
			'sucursal_id' => "nullable|numeric",
			'usuario_id' => "required|numeric",
			'supervisor_id'=>"required|numeric",
			'proyecto_id' => "required|numeric|exists:proyectos,id",
			
			'titulo' => "required|string|max:255",
			'descripcion' => "nullable|string",
			'direccion' => "nullable|string",
			'latitud' => "nullable|numeric",
			'longitud' => "nullable|numeric",
			'tipoevento' => "nullable|string",
			'fechainicio' => "nullable|date",
			'fecharegistro' => "nullable|date",
			'fechafin' => "nullable|date",
			'fecharecordatorio' => "nullable|date",
			'horarecordatorio' => "nullable|date_format:H:i",
			'temporizador' => "nullable|date_format:H:i",
			'recurrente' => "nullable|string",
			'periodo' => "nullable|string",
			'url' => "nullable|string"
    	]);

    	$agenda = Agenda::create($request->all());

    	return response()->json(["message"=>"Evento creado", "evento"=>$agenda->load('proyecto')],202); 
    }

    public function proyecto(Request $request)
    {
    	$request->validate([
    		"usuario_id" => "required|numeric",
    		"proyecto" => "required|exists:proyectos,nombre"
    	]);
    	$usuario_id = $request->usuario_id;
    	$proyecto_nombre = strtolower($request->proyecto);
    	$agendas = Agenda::where("usuario_id",$usuario_id)->whereHas("proyecto",function(Builder $query)use($proyecto_nombre){
    		$query->where("nombre",$proyecto_nombre);
    	})->with('proyecto')->get();
    	return response()->json(["message"=>"success",'eventos'=>$agendas],200);
    }
}
