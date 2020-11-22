<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

public function __construct()
{
    $this->middleware('auth.basic',['only'=>['store','update','destroy']]);
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project=Project::all();
        //return 'Mostrar la lista de todos los poryectos  ' . $project;
        return response()->json(['Acceso a Proyectos'=>$project],202);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'Mostrar menu para crear  poryectos  ';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if(!$request->get('Nombre') || !$request->get('Descripcion')){
        return response()->json(['mensaje'=>'faltan datos','codigo'=>422],422);
       }
       Project::create($request->all());
      
        return response()->json(['mensaje'=>'Proyecto Creado'],202);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project=Project::find($id);
        //return 'Mostrar la lista de todos los poryectos  ' . $project;
        if(!$project){
            return response()->json(['mensaje '=>'No se encontro el proyecto','codigo'=>404],404);
        }
        return response()->json(['Acceso a Proyectos'=>$project],202);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return 'Mostrar formulario para editar proyecto  con id '.$id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        return 'Mostrar formulario para modificar proyecto  con id '.$id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        return 'Mostrar formulario para eliminar proyecto  con id '.$id;
    }
}
