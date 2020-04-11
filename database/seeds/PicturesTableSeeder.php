<?php

use Illuminate\Database\Seeder;
use App\Professor;
use App\Picture;
class PicturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Professor::all()->each(function(App\Professor $professor) {
            $professor->pictures()->saveMany(factory(App\Picture::class, 2)->make());//TODO: check App\Post::class
        });
    }
}
