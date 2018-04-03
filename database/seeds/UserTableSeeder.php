<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  =>  'Administrator',
            'email' =>  'pha@gmail.com',
            'password'  =>  'mmfi.b0ss'
        ]);

        User::create([
            'name'  =>  'user',
            'email' =>  'user@gmail.com',
            'password'  =>  'user'
        ]);
    }
}
