<?php

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
    	//membuat 5 data faker dari factory
        factory(App\User::class, 5)->create();
    }
}
