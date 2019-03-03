<?php

use App\Course;
use Faker\Generator as Faker;

$factory->define(App\Requirement::class, function (Faker $faker) {
    return [
        'course_id' => Course::all()->random()->id,
        'requirement' => $faker->sentence,
    ];
});
