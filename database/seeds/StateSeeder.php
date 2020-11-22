<?php

use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
for ($i=0;$i <3;$i++)
{
    Project::create
    ([
        'Nombre'=>$faker->word(10),
        'Descripcion'=>$faker->word(20)
    ]);

        }
    }
}
