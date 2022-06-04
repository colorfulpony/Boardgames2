<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert(
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role_id' => 3,
                'password' => Hash::make('mak7ka321'),
            ],
        );
        DB::table('users')->insert(
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'role_id' => 2,
                'password' => Hash::make('mak7ka321'),
            ],
        );
        DB::table('users')->insert(
            [
                'name' => 'guest',
                'email' => 'guest@gmail.com',
                'role_id' => 1,
                'password' => Hash::make('mak7ka321'),
            ]
        );
    }
}
