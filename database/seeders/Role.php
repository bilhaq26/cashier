<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')
            ->insert([
                'name' => 'Developer',
            ]);

        DB::table('roles')
            ->insert([
                'name' => 'Admin',
            ]);

        DB::table('roles')
            ->insert([
                'name' => 'Kasir',
            ]);

        DB::table('roles')
            ->insert([
                'name' => 'Gudang',
            ]);
    }
}
