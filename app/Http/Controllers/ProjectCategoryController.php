<?php

namespace App\Http\Controllers;

use App\Project;
//use App\Category;
use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $project=Project::find($id);
        $category=$project->categories;
        if(!$project){
            return response()->json(['mensaje '=>'No se encontro el proyecto','codigo'=>404],404);
        }
        return response()->json(['Acceso a categorias'=>$category],202);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'Mostrar formulario para crear una categoria'.$id;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($idproject, $idcategory)
    {
        return "Mostrando la categoria". $idcategory.'del proyecto'.$idproject;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($idproject, $idcategory)
    {
        return 'Mostrar formulario para editar una categoria'.$idcategory.' del proyecto '.$idproject;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update($idproject,  $idcategoryidcategory)
    {
        return 'Mostrar formulario para actualizar una categoria'.$idcategory.' del proyecto '.$idproject;
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
