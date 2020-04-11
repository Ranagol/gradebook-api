<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Professor;
use Faker\Generator as Faker;

$factory->define(Professor::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
    ];
});
