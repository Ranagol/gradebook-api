<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Picture;
use App\Professor;
use Faker\Generator as Faker;

$factory->define(Picture::class, function (Faker $faker) {
    $professorIds = Professor::all()->pluck('id')->toArray();
    return [
        'professor_id' => $faker->randomElement($professorIds),
        'picture_url' => 'https://www.fillmurray.com/420/320',
    ];
});
