<?php

use App\Student;
use App\Teacher;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 1)->create([
            'name' => 'Daniel',
            'last_name' => 'Buendia',
            'email' => 'buendy@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => \App\Role::ADMIN,

        ])->each(function (User $user){
            factory(Student::class, 1)->create(['user_id' => $user->id]);
        });

        factory(User::class, 50)->create(['role_id' => \App\Role::STUDENT])->each(function(User $user){
            factory(Student::class, 1)->create(['user_id' => $user->id]);
        });

        factory(User::class, 10)->create(['role_id' => \App\Role::TEACHER])->each(function(User $user){
            factory(Student::class, 1)->create(['user_id' => $user->id]);
            factory(Teacher::class, 1 )->create(['user_id' => $user->id]);
        });

    }
}
