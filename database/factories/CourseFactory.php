<?php

use App\Category;
use App\Level;
use App\Teacher;
use Faker\Generator as Faker;
use App\Course;

$factory->define(App\Course::class, function (Faker $faker) {

    $name = $faker->sentence;
    $status = $faker->randomElement([Course::PUBLISHED, Course::PENDING, Course::REJECTED]);

    return [
        'teacher_id' => Teacher::all()->random()->id, //Asignará una id que exista en la tabla mencionada
        'category_id' => Category::all()->random()->id,
        'level_id' => Level::all()->random()->id,
        'name' => $name,
        'description' => $faker->paragraph,
        'slug' => str_slug($name,'-'),
        'picture' => \Faker\Provider\Image::image(storage_path() . '/app/public/courses', 600, 350, 'business', false),
        'status' => $status,            //Esta función reemplazará los caracteres no validos en una url por guiones
        'previous_approved' => $status !== Course::PUBLISHED ? false : true,
        'previous_rejected' => $status === Course::REJECTED ? true : false,


    ];
});
