<?php

use App\Role;
use Faker\Generator as Faker;
use Faker\Provider\Image;

$factory->define(App\User::class, function (Faker $faker) {
    $name = $faker->name;
    $lastName = $faker->lastName;
    return [
        'name' => $name,
        'role_id' => Role::all()->random()->id,
        'last_name' => $lastName,
        'slug' => str_slug($name . ' ' . $lastName, '-'),
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'picture' => Image::image(storage_path() . '/app/public/users', 200, 200, 'people', false),
    ];
});
