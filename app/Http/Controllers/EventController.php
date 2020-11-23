<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event=Event::all();//where()

        //return 'Mostrar la lista de todos los poryectos  ' . $project;
        return response()->json(['Acceso a Eventos'=>$event],202);
  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->get('direccion') || !$request->get('latitud')
        || !$request->get('longitud') || !$request->get('titulo')
        || !$request->get('tipoevento') || !$request->get('descripcion')
        || !$request->get('fechainicio') || !$request->get('fechafin')
        || !$request->get('horainicio') || !$request->get('horafin')
        || !$request->get('fecharecordatorio') || !$request->get('horariorecordatorio')
        || !$request->get('recurrente') || !$request->get('periodo')
        || !$request->get('url') || !$request->get('temporizador' )){

            return response()->json(['mensaje'=>'faltan datos','codigo'=>422],422);
           }

           Event::create($request->all());
          
            return response()->json(['mensaje'=>'Evento Creado','codigo'=>202],202);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event=Event::find($id);
        //return 'Mostrar la lista de todos los poryectos  ' . $project;
        if(!$event){
            return response()->json(['mensaje '=>'No se encontro el evento','codigo'=>404],404);
        }
        return response()->json(['Acceso a Eventos'=>$event],202);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $metodo=$request->method();
        
        $event=Event::find($id);
        $flag=false;

        if($metodo==="PATCH"){
           
            $direccion=$request->get('direccion'); 
            if($direccion!=null && $direccion!=''){
                $event->direccion=$direccion;
                $flag=true;
            } 
            $latitud=$request->get('latitud');
        if($latitud!=null && $latitud!=''){
            $event->latitud=$latitud;
            $flag=true;
        } 
         $longitud=$request->get('longitud');
        if($longitud!=null && $longitud!=''){
            $event->longitud=$longitud;
            $flag=true;
        } 
         $titulo=$request->get('titulo');
        if($titulo!=null && $titulo!=''){
            $event->titulo=$titulo;
            $flag=true;
        } 
        $tipoevento=$request->get('tipoevento');
        if($tipoevento!=null && $tipoevento!=''){
            $event->tipoevento=$tipoevento;
            $flag=true;
        } 
        $descripcion=$request->get('descripcion');
        if($descripcion!=null && $descripcion!=''){
            $event->descripcion=$descripcion;
            $flag=true;
        } 
        $fechainicio=$request->get('fechainicio');
        if($fechainicio!=null && $fechainicio!=''){
            $event->fechainicio=$fechainicio;
            $flag=true;
        } 
        $fechafin=$request->get('fechafin');
        if($fechafin!=null && $fechafin!=''){
            $event->fechafin=$fechafin;
            $flag=true;
        } 
        $horainicio=$request->get('horainicio');
        if($horainicio!=null && $horainicio!=''){
            $event->horainicio=$horainicio;
            $flag=true;
        } 
        $horafin=$request->get('horafin');
        if($horafin!=null && $horafin!=''){
            $event->horafin=$horafin;
            $flag=true;
        } 
        $fecharecordatorio=$request->get('fecharecordatorio');
        if($fecharecordatorio!=null && $fecharecordatorio!=''){
            $event->fecharecordatorio=$fecharecordatorio;
            $flag=true;
        } 
        $horariorecordatorio=$request->get('horariorecordatorio');
        if($horariorecordatorio!=null && $horariorecordatorio!=''){
            $event->horariorecordatorio=$horariorecordatorio;
            $flag=true;
        } 
        $recurrente=$request->get('recurrente');
        if($recurrente!=null && $recurrente!=''){
            $event->recurrente=$recurrente;
            $flag=true;
        } 
        $periodo=$request->get('periodo');
        if($periodo!=null && $periodo!=''){
            $event->periodo=$periodo;
            $flag=true;
        } 
        $url=$request->get('url');
        if($url!=null && $url!=''){
            $event->url=$url;
            $flag=true;
        } 
        $temporizador=$request->get('temporizador');
        if($temporizador!=null && $temporizador!=''){
            $event->temporizador=$temporizador;
            $flag=true;
        } 
           

            if($flag){
            $project->save();
            return response()->json(['mensaje'=>'Evento Editado con exito','codigo'=>202],202);
            }
            return response()->json(['mensaje'=>'No se hicieron los cambios','codigo'=>200],200);
        }
        $direccion=$request->get('direccion');
        $latitud=$request->get('latitud');
        $longitud=$request->get('longitud');
        $titulo=$request->get('titulo');
        $tipoevento=$request->get('tipoevento');
        $descripcion=$request->get('descripcion');
        $fechainicio=$request->get('fechainicio');
        $fechafin=$request->get('fechafin');
        $horainicio=$request->get('horainicio');
        $horafin=$request->get('horafin');
        $fecharecordatorio=$request->get('fecharecordatorio');
        $horariorecordatorio=$request->get('horariorecordatorio');
        $recurrente=$request->get('recurrente');
        $periodo=$request->get('periodo');
        $url=$request->get('url');
        $temporizador=$request->get('temporizador');

        if(!$direccion || !$latitud
           || !$longitud || !$titulo
           || !$tipoevento ||!$descripcion
           || !$fechainicio || !$fechafin
           || !$horainicio || !$horafin
           || !$fecharecordatorio || !$horariorecordatorio
           || !$recurrente || !$periodo
           || !$url || !$temporizador
        
        ){
            return response()->json(['mensaje '=>'Datos Invalidos','codigo'=>404],404);
        }

        $event->direccion=$direccion;
        $event->latitud=$latitud;
        $event->longitud=$longitud;
        $event->titulo=$titulo;
        $event->tipoevento=$tipoevento;
        $event->descripcion=$descripcion;
        $event->fechainicio=$fechainicio;
        $event->fechafin=$fechafin;
        $event->horainicio=$horainicio;
        $event->horafin=$horafin;
        $event->fecharecordatorio=$fecharecordatorio;
        $event->horariorecordatorio=$horariorecordatorio;
        $event->recurrente=$recurrente;
        $event->periodo=$periodo;
        $event->url=$url;
        $event->temporizador=$temporizador;
        $event->save();
      
        return response()->json(['mensaje'=>'Evento Grabado con exito','codigo'=>202],202);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event=Event::find($id);
        if(!$event){
            return response()->json(['mensaje'=>'Evento no se encuentra ','codigo'=>202],202);
        }
        /*
        $category=$project->categories;
        if(sizeof($category)>0){
            return response()->json(['mensaje'=>'Proyecto posee categorias no se puede eliminar','codigo'=>404],404);
        }*/

        $event->delete();
        return response()->json(['mensaje'=>'Evento eliminado ','codigo'=>200],200);
    }
}
