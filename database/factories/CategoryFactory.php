<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(
            [
                'PHP', 'JAVASCRIPT', 'JAVA', 'DISEÑO WEB', 'SERVIDORES', 'VUE', 'MYSQL',
                'AWS', 'BIGDATA', 'DIGITAL OCEAN'
            ]),
        'description' => $faker->sentence
    ];
});
