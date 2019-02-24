<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        DB::table('users')->insert([
            'name' => 'Bertho',
            'email' => 'bertho@gmail.com',
            'password' => Hash::make('admin')
        ]);
    }
}
