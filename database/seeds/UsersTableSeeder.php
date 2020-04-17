<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(App\User::class, 35)->create()
            ->each(function(App\User $user) {//TODO LOSI EZ ITT NEM JO, NEM LEHET SEEDELNI
                $professor = new App\Professor();
                $professor->first_name = $user->first_name;
                $professor->last_name = $user->last_name;

                $user->professor()->save($professor);
            });
    }
}
