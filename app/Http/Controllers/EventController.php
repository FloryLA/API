<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Event;
use App\Timezone;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EventUpdate;
use App\Http\Requests\EventRequest;
use App\Http\Resources\Event as EventResource;
use App\Http\Resources\EventCollection;
use App\Http\Controllers\ApiController;

use Illuminate\Database\Eloquent\Builder;


class EventController extends ApiController
{

    
    public function index()
    {
       $events=Event::all();
 
        $resource = new EventCollection($events);
        return response()->json(['data'=>$resource],200);
  
    }

    
    public function store(EventRequest $request)
    {
            
          //  $this->validate($request);
          $fecha_inicio = (
            $request->fechainicio ? (
              $request->horainicio ? (
                $request->fechainicio." ".$request->horainicio
                ) : $request->fechainicio." 00:00:00"
              ) : null
          );

          $fecha_fin = (
            $request->fechafin ? (
              $request->horafin ? (
                $request->fechafin." ".$request->horafin
                ) : $request->fechafin." 00:00:00"
              ) : null
          );

          $fecha_recordatorio = (
            $request->fecharecordatorio ? (
              $request->horarecordatorio ? (
                $request->fecharecordatorio." ".$request->horarecordatorio
                ) : $request->fecharecordatorio." 00:00:00"
              ) : null
          );

          $parametros=[
         
                'empresa_id'=>$request->empresa_id,
                'sucursal_id'=>$request->sucursal_id,
                'usuario_id' =>$request->usuario_id,
                'supervisor_id'=>$request->supervisor_id,
                'project_id' =>$request->project_id,
                'contacto_id' =>$request->contacto_id,
               
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'direccion' => $request->direccion,
                'latitud' =>$request->latitud,
                'longitud' => $request->longitud,
                'tipoevento' =>$request->tipoevento,
                'fecharegistro' => $request->fecharegistro,
                'inicio' =>$fecha_inicio,
                'fin' => $fecha_fin,
                'recordatorio' => $fecha_recordatorio,
              //'horarecordatorio' => $request->fecharecordatorio.' '.$request->horarecordatorio,
                'temporizador'=> $request->temporizador,
                'recurrente'=> $request->recurrente,
                'periodo' => $request->periodo,
                'url' => $request->url,

          ];
           // dd($parametros);
           $events=Event::create($parametros);

         
           //return $this->showOne($events->load('project'));
           $resource = new EventResource($events);
           return response()->json(['data'=>$resource],201);
        
        }

   
    public function show(Request $request,Event $evento)
    {
        
       if(!$evento){
            return response()->json(['mensaje '=>'No se encontro el evento hora:','codigo'=>404],404);
        }
      
             $resource = new EventResource($evento);
       return response()->json(["data"=>$resource],200);
       
    }

  public function getEvents(Request $request)
    {
      $request->validate([
        "usuario_id" => "required|numeric",
        "fecha" => "required|date",
        "zona_horaria" => "required|exists:timezones,nombre"
     
    ]);

    DB::connection()->enableQueryLog();
    $queries = DB::getQueryLog();
    $usuario_id = $request->usuario_id;

    $fecha = new Carbon($request->fecha,$request->zona_horaria);
    $fecha_utc = $fecha->setTimezone('UTC');

    $desde = $fecha->toDateTimeString();
    $hasta = $fecha->add('days',1)->toDateTimeString();
    $eventos = Event::where("usuario_id",$usuario_id)->where(function(Builder $query)use($desde,$hasta){
      $query->whereBetween('inicio',[$desde,$hasta])->orWhereBetween("recordatorio",[$desde,$hasta]);
    })->get();

    foreach ($eventos as $evento) {
      $fechar= new Carbon($evento->fecharegistro,"UTC");
      $evento->fecharegistro = $fechar->setTimezone($request->zona_horaria)->toDateTimeString(); 
      
      $ini = new Carbon($evento->inicio,"UTC");
      $evento->inicio = $ini->setTimezone($request->zona_horaria)->toDateTimeString();

      $fin = new Carbon($evento->fin,"UTC");
      $evento->fin = $fin->setTimezone($request->zona_horaria)->toDateTimeString();

      $recordatorio = new Carbon($evento->recordatorio,"UTC");
      $evento->recordatorio =$recordatorio->setTimezone($request->zona_horaria)->toDateTimeString();
    }

    $resource = new EventCollection($eventos);
    return response()->json(['data'=>$resource],200);
    //return $this->showOne($resource);
    }

    //============Endpoint eventos por usario============

    public function Eventsusuario(Request $request)
    {
      $request->validate([
        "usuario_id" => "required|numeric",
        "zona_horaria" => "required|exists:timezones,nombre"
    ]);
    $usuario_id = $request->usuario_id;
    $zona_horaria = $request->zona_horaria;
    $eventos = Event::where("usuario_id",$usuario_id)->get();

    foreach ($eventos as $evento) {
   
      $fechar= new Carbon($evento->fecharegistro,"UTC");
      $evento->fecharegistro = $fechar->setTimezone($request->zona_horaria)->toDateTimeString();

      $ini = new Carbon($evento->inicio,"UTC");
      $evento->inicio = $ini->setTimezone($request->zona_horaria)->toDateTimeString();

      $fin = new Carbon($evento->fin,"UTC");
      $evento->fin = $fin->setTimezone($request->zona_horaria)->toDateTimeString();

      $recordatorio = new Carbon($evento->recordatorio,"UTC");
      $evento->recordatorio =$recordatorio->setTimezone($request->zona_horaria)->toDateTimeString();
    }
    $resource = new EventCollection($eventos);
    return response()->json(['data'=>$resource],200);
  
    }

     
    public function update(EventUpdate $request, Event $evento)
    {  
      $fecha_inicio = (
        $request->fechainicio ? (
          $request->horainicio ? (
            $request->fechainicio." ".$request->horainicio
            ) : $request->fechainicio." ".$evento->hora_inicio
          ) : $evento->inicio
      );

      $fecha_fin = (
        $request->fechafin ? (
          $request->horafin ? (
            $request->fechafin." ".$request->horafin
            ) : $request->fechafin." ".$evento->hora_fin
          ) : $evento->fin
      );

      $fecha_recordatorio = (
        $request->fecharecordatorio ? (
          $request->horarecordatorio ? (
            $request->fecharecordatorio." ".$request->horarecordatorio
            ) : $request->fecharecordatorio." ".$evento->hora_recordatorio
          ) : $evento->recordatorio
      );

      $parametros=[
     
      'empresa_id' => $request->empresa_id ? $request->empresa_id : $evento->empresa_id,
      'sucursal_id' =>$request->sucursal_id ? $request->sucursal_id : $evento->sucursal_id,
      'usuario_id' => $request->usuario_id ? $request->usuario_id : $evento->usuario_id,
      'supervisor_id'=>$request->supervisor_id ? $request->supervisor_id : $evento->supervisor_id,
      'project_id' => $request->project_id ? $request->project_id : $evento->project_id,
      'contacto_id' => $request->contacto_id ? $request->contacto_id : $evento->contacto_id,

      'titulo' => $request->titulo ? $request->titulo : $evento->titulo,
      'descripcion' => $request->descripcion ? $request->descripcion : $evento->descripcion,
      'direccion' => $request->direccion ? $request->direccion : $evento->direccion,
      'latitud' =>$request->latitud ? $request->latitud : $evento->latitud,
      'longitud' => $request->longitud ? $request->longitud : $evento->longitud,
      'tipoevento' =>$request->tipoevento ? $request->tipoevento : $evento->tipoevento,
      'fecharegistro' => $request->fecharegistro ? $request->fecharegistro : $evento->fecharegistro,
      'inicio' =>$fecha_inicio,
      'fin' => $fecha_fin,
      'recordatorio' => $fecha_recordatorio,
      //'horarecordatorio' => $request->fecharecordatorio.' '.$request->horarecordatorio,
      'temporizador' =>$request->temporizador ? $request->temporizador : $evento->temporizador,
      'recurrente' => $request->recurrente ? $request->recurrente : $evento->recurrente,
      'periodo' => $request->periodo ? $request->periodo : $evento->periodo,
      'url' => $request->url ? $request->url : $evento->url,

      ];
    
        $evento->update($parametros);
        $resource = new EventResource($evento);
        return response()->json(['data'=>$resource],201);
               
     


    }


    public function proyecto(Request $request,Event $evento)
    {
        DB::connection()->enableQueryLog();
        $queries = DB::getQueryLog();
         
        $request->validate([
    		"usuario_id" => "required|numeric",
    		"project" => "required|exists:projects,nombre"
      ]);
      
    	  $usuario_id = $request->usuario_id;
        $proyecto_nombre = strtolower($request->proyecto);
        
       $agendas = Event::where("usuario_id","=",$usuario_id)
        ->whereHas("project",function(Builder $query)use($proyecto_nombre){$query
        ->where("nombre",$proyecto_nombre);})->with('project')->get();
     
        //return $this->showAll($agendas);
         var_dump($agendas);
        return response()->json(['data'=>$agendas],200);
    }



    public function destroy(Event $evento)
    {
       
        if(!$evento){
            return response()->json(['mensaje'=>'Evento no se encuentra ','codigo'=>202],202);
        }

        $evento->delete();
        $resource = new EventResource($evento);
        return response()->json(["message"=>"success",'data'=>$resource],200);
        
     return $this->showOne($evento);
    }
}
