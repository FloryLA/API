<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Requests\EventCreateRequest;

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
      // $event=Event::find();
       //return 'Mostrar la lista de todos los poryectos  ' . $project;
   /*    if(!$event){
           return response()->json(['mensaje '=>'No se encontro el evento','codigo'=>404],404);
       }
       return response()->json(['Acceso a Eventos'=>$event],202);
  */
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
    public function store(EventCreateRequest $request)
    {
    /*  if(!$request->get('direccion') || !$request->get('latitud')
        || !$request->get('longitud') || !$request->get('titulo')
        || !$request->get('tipoevento') || !$request->get('descripcion')
        || !$request->get('fechainicio') || !$request->get('fechafin')
        || !$request->get('horainicio') || !$request->get('horafin')
        || !$request->get('fecharecordatorio') || !$request->get('horarecordatorio')
        || !$request->get('recurrente') || !$request->get('periodo')
        || !$request->get('url') || !$request->get('temporizador' )
        || !$request->get('zonahoraria')){*/

          /*  $this->validate( $request,
        ['direccion'=>'required'],
        ['direccion.required'=>'Es necesario ingresar una direccion para el evento'],
        ['latitud'=>'required'],
        ['longitud'=>'required'],
        ['titulo'=>'required'],
        ['tipoevento'=>'required'],
        ['descripcion'=>'required'],
        ['fecharegistro'=>'required'],
        ['fechainicio'=>'required'],
        ['fechafin'=>'required'],
        ['horainicio'=>'required'],
        ['horafin'=>'required'],
        ['fecharecordatorio'=>'required'],
        ['horarecordatorio'=>'required'],
        ['recurrente'=>'required'],
        ['periodo'=>'required'],
        ['url'=>'required'],
        ['temporizador'=>'required'],
        ['zonahoraria'=>'required'],
        ['usuario_id'=>'required']
            );
             
            /*if(!$validate=""){
          return response()->json(['mensaje'=>'faltan datos','codigo'=>422],422);
            }*/

           Event::create($request->all());
            return response()->json(['mensaje'=>'Evento Creado','codigo'=>202],202);
           
        
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $fecharegistro)
    {
        //$event=Event::find($id);
        //$event=Event::find($id);
        $event=Event::where("fecharegistro","=",$fecharegistro)->get();         
        //return 'Mostrar la lista de todos los poryectos  ' . $project;
        if(!$event){
            return response()->json(['mensaje '=>'No se encontro el evento','codigo'=>404],404);
        }
        return response()->json(['Acceso a Eventos'=>$event],202);
    }




   /* public function getdate($fecharegistro)
    {        
        $event=Event::where('fecharegistro',$fecharegistro);
        //return 'Mostrar la lista de todos los poryectos  ' . $project;
        if(!$event){
            return response()->json(['mensaje '=>'No se encontro el evento','codigo'=>404],404);
        }
        return response()->json(['Acceso a Eventos'=>$event],202);
    }
*/



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
      
        $event=Event::find($id);
        $flag=false;

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
        $horarecordatorio=$request->get('horarecordatorio');
        if($horarecordatorio!=null && $horarecordatorio!=''){
            $event->horarecordatorio=$horarecordatorio;
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
        $zonahoraria=$request->get('zonahoraria');
        if($zonahoraria!=null && $zonahoraria!=''){
            $event->zonahoraria=$zonahoraria;
            $flag=true;
        }
            if($flag){
            $event->save();
            return response()->json(['mensaje'=>'Evento Editado con exito','codigo'=>202],202);
            }
            return response()->json(['mensaje'=>'No se hicieron los cambios','codigo'=>200],200);
    

        
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
