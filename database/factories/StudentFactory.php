<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use App\Gradebook;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    $gradebookIds = Gradebook::all()->pluck('id')->toArray();
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'url_slika' => 'http://lorempixel.com/100/100/people',
        'gradebook_id' => $faker->randomElement($gradebookIds),
    ];
});
