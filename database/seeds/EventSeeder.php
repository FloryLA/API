<?php

use Illuminate\Database\Seeder;
//use App\State;
use App\Event;
use Faker\Factory as Faker;
class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker=Faker::create('es_Es');
        //$cantidad =State::all()->count();
        for ($i=0;$i <10;$i++)
        {
        Event::create
        ([
        'direccion'=>$faker->Address(),
        'latitud'=>$faker->word(),
        'longitud'=>$faker->word(),
        'titulo'=>$faker->name(),
        'tipoevento'=>$faker->word(),
        'descripcion'=>$faker->word(),
        'fechainicio'=>$faker->date(),
        'fechafin'=>$faker->date(),
        'horainicio'=>$faker->time(),
        'horafin'=>$faker->time(),
        'fecharecordatorio'=>$faker->date(),
        'horariorecordatorio'=>$faker->time(),
        'recurrente'=>$faker->word(),
        'periodo'=>$faker->word(),
        'url'=>$faker->Image(),
        'temporizador'=>$faker->time()
        //'state'=>$faker->numberBetween(1,$cantidad)
        ]);

        }
    }
}
