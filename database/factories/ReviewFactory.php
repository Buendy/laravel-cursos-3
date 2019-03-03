<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    return [
        'course_id' => \App\Course::all()->random()->id,
        'rating' => $faker->numberBetween(1,5)
    ];
});
