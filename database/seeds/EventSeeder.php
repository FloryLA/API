<?php

use Illuminate\Database\Seeder;
//use App\State;
use App\Event;
class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        
        Event::create
        ([
            "direccion"=>"Ruela Gamboa, 5, Entre suelo 1º, 29090, Os Lucio ",
            "latitud"=>"32.4568567",
            "longitud"=>"-35.4568567",
            "titulo"=> "Ángela Solano",
            "tipoevento"=>"placeat",
            "descripcion"=>"sit",
            'fecharegistro'=>'2006-10-26',
            "fechainicio"=>"2006-10-27",
            "fechafin"=>"1991-10-16",
            "horainicio"=>"20:50:07",
            "horafin"=>"05:34:44",
            "fecharecordatorio"=>"2001-07-09",
            "horarecordatorio"=>"15:41:41",
            "recurrente"=>"est",
            "periodo"=>"sapiente",
            "url"=>"https://laravel.com/docs/8.x/migrations#introduction",
            "temporizador"=>"17:58:44",
            'zonahoraria'=>'2006-10-27',
            'usuario_id'=>'2'

        //'state'=>$faker->numberBetween(1,$cantidad)
        //'usuario'=>$faker->numberBetween(1,$cantidad)

        ]);
        
    }
}
