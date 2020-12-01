<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\EventCreateRequest;

class EventController extends ApiController
{
    
    public function index()
    {
       $event=Event::all();//where()
       //return 'Mostrar la lista de todos los poryectos  ' . $project;
      return response()->json(['data'=>$event],202);
     //return $this->showAll($event);
     
  
    }

    
    public function store(EventCreateRequest $request,Event $event)
    {
   
           $events=Event::create($request->all());

           //return $this->showOnel($event);
            return response()->json(['mensaje'=>'Evento Creado','codigo'=>202],202);
           
        
        }

   
    public function show(Request $request, $id)
    {
        //$event=Event::find($id);
       $event=Event::find($id);
       // return $this->showOne($event);
       /* $event=Event::where('id_usuario',"=",$id_usuario)
        ->where('fecharecordatorio','=',$fechanotificacion)
         ->where('fecharegistro','=',$fecharegistro)->get(); */        
        //return 'Mostrar la lista de todos los poryectos  ' . $project;
       if(!$event){
            return response()->json(['mensaje '=>'No se encontro el evento','codigo'=>404],404);
        }
        return response()->json(['data'=>$event],202);
    }


    public function getEvents(Request $request)
    {
        $request->validate([
            "usuario_id" => "required|numeric",
            "fecha" => "required|date",
          //'zonahororia'=>"required|date"
        ]);

        $usuario_id = $request->usuario_id;
        $fecha = $request->fecha;

        $eventos = Event::where("usuario_id","=",$usuario_id)->where(function($query)use($fecha){
            $query->where('fechainicio',$fecha)->orWhere('fecharecordatorio',$fecha);
        })->get();
        return response()->json(['mensaje'=>'Success',"eventos"=>$eventos,'codigo'=>202],202);
    }
 

    public function update(Request $request, $id)
    {
        $request->validate([
    		'empresa_id' => "nullable|numeric",
			'sucursal_id' => "nullable|numeric",
			'usuario_id' => "required|numeric",
			'supervisor_id'=> "required|numeric",
			'project_id' => "required|numeric|exists:projects,id",
			
			'titulo' => "required|string|max:255",
			'descripcion' =>"nullable|string",
			'direccion' => "nullable|string",
			'latitud' => "nullable|numeric",
			'longitud' => "nullable|numeric",
            'tipoevento' => "nullable|string",
            'fecharegistro' => "nullable|date",
			'fechainicio' => "nullable|date",
            'fechafin' => "nullable|date",
            'horainicio'=> "nullable|date_format:H:i",
            'horafin'=> "nullable|date_format:H:i",
			'fecharecordatorio' => "nullable|date",
			'horarecordatorio' => "nullable|date_format:H:i",
			'temporizador' => "nullable|date_format:H:i",
			'recurrente' => "nullable|string",
			'periodo' => "nullable|string",
			'url' => "nullable|string"
    	]);

    	$agenda = Event::create($request->all());

    	return response()->json(["message"=>"Evento creado", "evento"=>$agenda->load('project')],202); 
    }


    public function proyecto(Request $request)
    {
    	$request->validate([
    		"usuario_id" => "required|numeric",
    		"projects" => "required|exists:projects,nombre"
    	]);
    	$usuario_id = $request->usuario_id;
    	$proyecto_nombre = strtolower($request->proyecto);
        $agendas = Event::where("usuario_id",$usuario_id)
        ->whereHas("projects",function(Builder $query)use($proyecto_nombre){$query
        ->where("nombre",$proyecto_nombre);
        })->with('projects')->get();
        return response()->json(["message"=>"success",'eventos'=>$agendas],200);
        //return $this->showOne($event);
    }
   


    public function destroy( $id)
    {
        $event=Event::find($id);
        if(!$event){
            return response()->json(['mensaje'=>'Evento no se encuentra ','codigo'=>202],202);
        }

        $event->delete();
     return response()->json(['mensaje'=>'Evento eliminado ','codigo'=>200],200);
    //  return $this->showOne($event);
    }
}
