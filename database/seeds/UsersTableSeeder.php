<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => "memotiur",
            'email' => "memotiur@gmail.com",
            'password' => Hash::make('123456'),
            'user_type' => 1
        ]);
    }
}
