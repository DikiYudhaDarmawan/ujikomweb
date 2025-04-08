<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Gelombang_belajarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gelombang = [
    ['gelombang' => '1'],
    ['gelombang' => '2'],
    ['gelombang' => '3'],
];
DB::table('Gelombang_belajars')->insert( $gelombang);

    }
}