<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'org_id' => 1,
            'is_owner' => 1,
            'email' => 'admin@hungthinh.edu.vn',
            'full_name' => 'Admin Hung Thinh',
            'password' => Hash::make('123123'),
        ]);
        DB::table('users')->insert([
            'org_id' => 1,
            'is_owner' => 0,
            'email' => 'user@hungthinh.edu.vn',
            'full_name' => 'User Hung Thinh',
            'password' => Hash::make('123123'),
        ]);

        DB::table('users')->insert([
            'org_id' => 2,
            'is_owner' => 1,
            'email' => 'admin2@hungthinh.edu.vn',
            'full_name' => 'Admin Hung Thinh2',
            'password' => Hash::make('123123'),
        ]);
        DB::table('users')->insert([
            'org_id' => 2,
            'is_owner' => 0,
            'email' => 'user2@hungthinh.edu.vn',
            'full_name' => 'User Hung Thinh2',
            'password' => Hash::make('123123'),
        ]);
        DB::table('users')->insert([
            'org_id' => 3,
            'is_owner' => 1,
            'email' => 'admin3@hungthinh.edu.vn',
            'full_name' => 'Admin Hung Thinh3',
            'password' => Hash::make('123123'),
        ]);
        DB::table('users')->insert([
            'org_id' => 3,
            'is_owner' => 0,
            'email' => 'user3@hungthinh.edu.vn',
            'full_name' => 'User Hung Thinh3',
            'password' => Hash::make('123123'),
        ]);
    }
}
