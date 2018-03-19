<?php

use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $professors = User::faculty()->pluck('id')->toArray();

        for ($i=0; $i < 15; $i++) { 
            $id = $faker->numberBetween(100000, 399999);

            $user = [
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'middle_name' => $faker->lastName,
                'username' => $id,
                'password' => bcrypt('password'),
                'user_type' => 3
            ];

            $model = User::create($user);
            
            $model->student()->create([
                'student_no' => $id,
                'academic_attended' => 'College',
                'yr_level' => '2nd',
                'course' => 'Bachelor of Science in Information Technology',
            ]);

            $model->student->professors()->sync($professors);
        }

    }
}
