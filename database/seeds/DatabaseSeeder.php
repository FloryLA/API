<?php

use Illuminate\Database\Seeder;
use App\user;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        
        $this->call(ProjectSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(EventSeeder::class);

        User::truncate();
        $this->call(UserSeeder::class);
    }
}
