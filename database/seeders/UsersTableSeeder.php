<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            [
                //admin
            'name'=>'george',
            'email'=>'george@gmail.com',
            'password'=>Hash::make('georgegeorge'),
            'role_as'=>'1',
            ]
        ]);
    }
}
