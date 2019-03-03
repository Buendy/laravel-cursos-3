<?php

use App\Course;
use App\Goal;
use App\Requirement;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Course::class, 50)->create()
            ->each(function (Course $course){
               $course->goals()->saveMany(factory(Goal::class, 2)->create());
               $course->requirements()->saveMany(factory(Requirement::class, 4)->create());

            });
    }
}
