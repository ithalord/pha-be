<?php

use Illuminate\Database\Seeder;
use App\Models\Previlege;

class PrevilegesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Previlege::create([
    		'description' => 'Event'
    	]);

    	Previlege::create([
    		'description' => 'Leave'
    	]);
    }
}
