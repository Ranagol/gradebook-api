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
            ->each(function(App\User $user) {
                $user->professor()->save([
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name
                ]);
            });
    }
}
