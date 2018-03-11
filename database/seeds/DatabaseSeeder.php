<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(UsersFacultySeeder::class);
        $this->call(UsersStudentSeeder::class);
        $this->call(QuestionTableSeeder::class);
    }
}
