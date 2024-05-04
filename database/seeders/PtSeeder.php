<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pt = array('PT A', 'PT B', 'PT C', 'PT D', 'PT E');

        for ($i = 0; $i < count($pt); $i++) {
            DB::table('pt')->insert([
                'pt_name' => $pt[$i],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
