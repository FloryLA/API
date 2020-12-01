<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Category;
use App\Project;
use App\State;
use App\Event;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/


$factory->define(Project::class, function (Faker $faker) {
    return [
        'nombre' => $faker->word,
        'descripcion' => $faker->paragraph(1),
       ];});
    

  /* $factory->define(State::class, function (Faker $faker) {
        return [
            'nombre' => $faker->word,
        
           ];});


$factory->define(Category::class, function (Faker $faker) {
    return [
        'nombre' => $faker->word,
        'descripcion' => $faker->paragraph(1),
        'id_project'=>Project::all()->random()->id,
       ];
});*/

$factory->define(Event::class, function (Faker $faker) {
  // $proyecto=Project::has('projects')->get()->random();
//   $estado=State::all()->except($proyecto->id)->random();
   
    return [

            'empresa_id'=>$faker->numberBetween(1,2),
            'sucursal_id'=>$faker->numberBetween(1,2),
            'usuario_id'=>$faker->numberBetween(1,2),
            'supervisor_id'=>$faker->numberBetween(1,2),
            'project_id'=>Project::all()->random()->id,

            'titulo'=> $faker->word,
            'descripcion'=>$faker->paragraph(1),
            'direccion'=>$faker->word,
            'latitud'=>63.3256412,
            'longitud'=>-36.3256412,
            'tipoevento'=>$faker->word,
            'fecharegistro'=>'2020-11-24 16:31:10',
            'fechainicio'=>'2020-11-24 16:31:10',
            'fechafin'=>'2020-11-24 16:31:10',
            'horainicio'=>'16:31',
            'horafin'=>'16:31',
            'fecharecordatorio'=>'2020-11-24 16:31:10',
            'horarecordatorio'=>'16:31',
            'temporizador'=>'16:31',
            'recurrente'=> $faker->word,
            'periodo'=>$faker->word,
            'url'=>"https://laravel.com/docs/8.x/migrations#introduction"
            
           // 'id_state'=>State::all()->random()->id,

       ];

});
