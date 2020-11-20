<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Project;
use App\Category;
use Faker\Factory as Faker;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker=Faker::create();
        $cantidad =Project::all()->count();
        
        for ($i=0;$i <$cantidad; $i++)
{
        Category::create
        ([
        'Nombre'=>$faker->word(10),
        'Descripcion'=>$faker->word(20),
        'project_id'=>$faker->numberBetween(1,$cantidad)

        ]);

          }



    }
}
