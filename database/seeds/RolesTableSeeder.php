<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Administrator',
            'level' => 1
        ]);

        Role::create([
            'name' => 'User',
            'slug' => 'user',
            'description' => 'User',
            'level' => 2
        ]);
    }
}
