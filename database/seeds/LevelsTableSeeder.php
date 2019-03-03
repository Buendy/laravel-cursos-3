<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Level::class, 1)->create(['name'=> 'Beginner']);
        factory(\App\Level::class, 1)->create(['name'=> 'Itermediate']);
        factory(\App\Level::class, 1)->create(['name'=> 'Advancedphp ']);
    }
}
