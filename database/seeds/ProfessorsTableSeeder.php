<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Professor;

class ProfessorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::all()->each(function(App\User $user) {	
            $user->professor()->saveMany(factory(App\Professor::class, 1)->make()); 
            //https://stackoverflow.com/questions/35042618/how-can-i-maintain-foreign-keys-when-seeding-database-with-faker

        });
    }
}
