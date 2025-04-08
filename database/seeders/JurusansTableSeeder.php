<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $jurusan = [
    ['nama' => 'RPL'],
    ['nama' => 'TKRO'],
    ['nama' => 'TBSM'],
];
DB::table('jurusans')->insert( $jurusan);

    }
}