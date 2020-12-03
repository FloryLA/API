<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\EventUpdate;
use App\Http\Requests\EventRequest;
class EventController extends ApiController
{
   
 /*   protected $evento;
public function __construct(Event $evento){

    $this->evento=$evento;
}*/
    
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

   
    public function show(Request $request,Event $evento)
    {
        //$event=Event::find($id);
       //$event=Event::find($id);
       // return $this->showOne($event);
       /* $event=Event::where('id_usuario',"=",$id_usuario)
        ->where('fecharecordatorio','=',$fechanotificacion)
         ->where('fecharegistro','=',$fecharegistro)->get(); */        
        //return 'Mostrar la lista de todos los poryectos  ' . $project;
      
       if(!$evento){
            return response()->json(['mensaje '=>'No se encontro el evento hora:','codigo'=>404],404);
        }
       // return response()->json(['data'=>$event],202);
       
       return $this->showOne($evento);
       
    }

    public function all($limit, array $data = [])
    {
        $posts = $this->post->with('categories')
            ->whereBetween('published_at', [Carbon::now($data['timezone']),Carbon::tomorrow($data['timezone'])]);
    }



    public function getEvents(Request $request)
    {
        $request->validate([
            "usuario_id" => "required|numeric",
            "fecha" => "required|date",
          //'zonahororia'=>"required|date"
        ]);
      
     // DB::connection()->enableQueryLog();
        $usuario_id = $request->usuario_id;
        $fecha = $request->fecha;
        $eventos = Event::where("usuario_id","=",$usuario_id)
        ->where(function($query)use($fecha){$query
        ->where('fechainicio',$fecha)
        ->orWhere('fecharecordatorio',$fecha);
        })->get();
      
     // $queries = DB::getQueryLog();
      //return response()->json([$queries]);
       return response()->json(['mensaje'=>'Success ',"eventos"=>$eventos,'codigo'=>202],202);
        /*  Auth::user()->timezone; // America/Toronto*/

        /* $query->whereDate($fecha, ">=", Carbon::now()->startOfDay()->tz(Auth::user()->timezone)->
            $query->whereDate($fecha, "<=",Carbon::now()->endOfDay()->tz(Auth::user()->timezone);*/
        // return $this->showAll($eventos);

    }
 

    public function update(EventUpdate $request, Event $evento)
    {   
        
       //$event=Event::findOrFail($id);
    
       $evento->update($request->all());
               
       // $event->update();
             return $this->showOne($evento);


    }


    public function proyecto(Request $request,Event $evento)
    {
    	$request->validate([
    		"usuario_id" => "required|numeric",
    		"project" => "required|exists:projects,nombre"
    	]);
    	$usuario_id = $request->usuario_id;
    	$proyecto_nombre = strtolower($request->proyecto);
        $agendas = $evento::where("usuario_id",$usuario_id)
        ->whereHas("project",function(Builder $query)use($proyecto_nombre){$query
        ->where("nombre",$proyecto_nombre);})->with('project')->get();
       // return response()->json(["message"=>"success",'eventos'=>$agendas],200);
        return $this->showOne($agendas);
    }
   


    public function destroy(Event $evento)
    {
        //$evento=Event::find($id);
        if(!$evento){
            return response()->json(['mensaje'=>'Evento no se encuentra ','codigo'=>202],202);
        }

        $evento->delete();
    // return response()->json(['mensaje'=>'Evento eliminado ','codigo'=>200],200);
     return $this->showOne($evento);
    }
}
