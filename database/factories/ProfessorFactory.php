<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Professor;
use App\User;
use Faker\Generator as Faker;

$factory->define(Professor::class, function (Faker $faker) {
    $userIds = User::all()->pluck('id')->toArray();//we want to use the already existing user id's, to create user_id in the professors table. So, we take all the users, we take all their id's, and put them into the $userIds array...
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        //'url_slika' => 'http://lorempixel.com/100/100/people',
        'user_id' => $faker->randomElement($userIds),//... so here we could take a random user id from the $userIds array, and assign it to a user_id in the professors table.
    ];
});
