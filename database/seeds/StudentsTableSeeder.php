<?php

use Illuminate\Database\Seeder;
use App\Gradebook;
use App\Student;
class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Gradebook::all()->each(function(App\Gradebook $gradebook) {	
            $gradebook->students()->saveMany(factory(App\Student::class, 5)->make());
        });
    }
}
