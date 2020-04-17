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
        factory(App\Professor::class, 35)->create();
    }
}
