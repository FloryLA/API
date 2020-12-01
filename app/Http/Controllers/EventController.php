<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\EventRequest;

class EventController extends ApiController
{
    
    public function index()
    {
       $event=Event::all();//where()
       //return 'Mostrar la lista de todos los poryectos  ' . $project;
    //  return response()->json(['data'=>$event],202);
     return $this->showAll($event);
     
  
    }

    
    public function store(EventRequest $request,Event $event)
    {
            
          //  $this->validate($request);
   
           $events=Event::create($request->all());
           //$agenda = Agenda::create($request->all());

           //return response()->json(["message"=>"Evento creado", "evento"=>$agenda->load('proyecto')],202); 
      
           return $this->showOne($events->load('project'));
          //  return response()->json(['mensaje'=>'Evento Creado','codigo'=>202],202);
           
        
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
       // return response()->json(['data'=>$event],202);
       return $this->showOne($event);
       
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
        //return response()->json(['mensaje'=>'Success',"eventos"=>$eventos,'codigo'=>202],202);
        return $this->showOne($eventos);
    }
 

    public function update(EventRequest $request, $id)
    {
       // $this->validate($request);
    $event=Event::findOrFail($id);
        $event->fill($request->only([
            'titulo',
            'descripcion',
        ]));
       
        if ($event->isClean()) {
           return $this->errorResponse('Debe especificar al menos un valor diferente para actualizar',422);
        }
        $event->save();
             return $this->showOne($event,201);


    }


    public function proyecto(Request $request)
    {
    	$request->validate([
    		"usuario_id" => "required|numeric",
    		"project" => "required|exists:projects,nombre"
    	]);
    	$usuario_id = $request->usuario_id;
    	$proyecto_nombre = strtolower($request->proyecto);
        $agendas = Event::where("usuario_id",$usuario_id)
        ->whereHas("project",function(Builder $query)use($proyecto_nombre){$query
        ->where("nombre",$proyecto_nombre);
        })->with('project')->get();
       // return response()->json(["message"=>"success",'eventos'=>$agendas],200);
        return $this->showOne($agendas);
    }
   


    public function destroy( $id)
    {
        $event=Event::find($id);
        if(!$event){
            return response()->json(['mensaje'=>'Evento no se encuentra ','codigo'=>202],202);
        }

        $event->delete();
    // return response()->json(['mensaje'=>'Evento eliminado ','codigo'=>200],200);
     return $this->showOne('Eliminado',$event);
    }
}
