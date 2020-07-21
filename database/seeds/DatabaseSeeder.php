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
    	//memanggil seeder dari User kedalam main seeder
        $this->call(UsersTableSeeder::class);

        //lalu, jalankan seed di terminal
        //php artisan db:seed

        //data sudah ter-generate di database
    }
}
