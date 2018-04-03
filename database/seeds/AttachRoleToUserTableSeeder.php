<?php

use Illuminate\Database\Seeder;
use App\User;
use Bican\Roles\Models\Role;

class AttachRoleToUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Find the first user created and
         * attach admin role
         */
        $admin = User::first();
        $roleAdmin = Role::first();
        $admin->attachRole($roleAdmin);

        /**
         * Find the second user created and
         * attach cashier role
         */
        $user = User::find(2);
        // $cashier2 = User::find(3);
        $rolUser = Role::where('slug', 'user')->first();

        $user->attachRole($rolUser);
        // $cashier2->attachRole($rolUser);

    }
}
