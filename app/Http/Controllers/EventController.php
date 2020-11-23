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
        $event=Event::all();
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
        if(!$request->get('direccion')|| !$request->get('latitud')
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
    public function update(Request $request, Event $event)
    {
        //
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
