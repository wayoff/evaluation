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
                'name' => $faker->name,
                'username' => $id,
                'password' => bcrypt('password'),
                'user_type' => 3
            ];

            $model = User::create($user);
            
            $model->student()->create([
                'student_no' => $id,
                'academic_attended' => 'College'
            ]);

            $model->student->professors()->sync($professors);
        }

    }
}
