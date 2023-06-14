<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Identity extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('identitas')->insert([
            'name' => 'Cashier',
            'logo' => 'lapor-mas.png',
            'favicon' => 'lapor-mas.png',
            'email' => 'email@email.com',
            'phone' => '08123456789',
            'address' => 'Jl. Jalan No. 1',
            'facebook' => 'https://facebook.com',
            'instagram' => 'https://instagram.com',
            'twitter' => 'https://twitter.com',
            'youtube' => 'https://youtube.com',
            'tiktok' => 'https://tiktok.com',
            'about' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nunc vel tincidunt lacinia, nunc nisl aliquam nisl, eget aliquam nisl',
        ]);
    }
}
