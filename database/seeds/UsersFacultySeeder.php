<?php

use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersFacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i < 15; $i++) { 
            $user = [
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'middle_name' => $faker->lastName,
                'username' => $faker->email,
                'password' => bcrypt('password'),
                'user_type' => 2
            ];

            User::create($user);
        }

    }
}
