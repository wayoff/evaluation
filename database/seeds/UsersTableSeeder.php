<?php

use App\User;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users = [
    		'name' => 'Iam Admin',
    		'username' => 'username',
    		'password' => bcrypt('password'),
    		'remember_token' => str_random(10)
    	];

        User::create($users);

    }
}