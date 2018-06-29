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
            'previlege_id' =>  1,
            'password'  =>  'pha.b0ss'
        ]);

        User::create([
            'name'  =>  'user',
            'email' =>  'user@gmail.com',
            'previlege_id' =>  1,
            'password'  =>  'user'
        ]);

        // User::create([
        //     'name'  =>  'Harold G. Pascual',
        //     'email' =>  'pha.hgp@gmail.com',
        //     'previlege_id' =>  2,
        //     'password'  =>  '!p$ssw0rd'
        // ]);
    }
}
