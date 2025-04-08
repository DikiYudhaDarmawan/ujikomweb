<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas = [
            ['tingkat' => '10', ],
            ['tingkat' => '11',],
            ['tingkat' => '12',],
        ];
        DB::table('kelas')->insert( $kelas);
    }

}