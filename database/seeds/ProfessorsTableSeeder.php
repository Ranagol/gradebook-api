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
        factory(App\Professor::class, 15)->create();//these are only dummy professors. The "real professors" are created either in the UsersTableSeeder, or later, automatically, during user registration. Behind real professor there is a registered user. The dummy professor is only in the db, for testing purpose.
    }
}
