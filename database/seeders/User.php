<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')
            ->insert([
                'photo' => 'billy.png',
                'name' => 'Developer',
                'username' => 'developer',
                'email' => 'developer@admin.com',
                'password' => Hash::make('ko2world'),
                'role_id' => '1',
                'status' => 'Active',
            ]);

        DB::table('users')
            ->insert([
                'photo' => 'billy.png',
                'name' => 'Billy',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('ko2world'),
                'role_id' => '2',
                'status' => 'Active',
            ]);

        DB::table('users')
        ->insert([
            'photo' => 'billy.png',
            'name' => 'Kasir',
            'username' => 'kasir',
            'email' => 'kasir@admin.com',
            'password' => Hash::make('ko2world'),
            'role_id' => '3',
            'status' => 'Active',
        ]);

        DB::table('users')
        ->insert([
            'photo' => 'billy.png',
            'name' => 'Gudang',
            'username' => 'gudang',
            'email' => 'gudang@admin.com',
            'password' => Hash::make('ko2world'),
            'role_id' => '4',
            'status' => 'Active',
        ]);
    }
}
