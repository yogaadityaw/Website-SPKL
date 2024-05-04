<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BengkelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bengkel = array('Bengkel A', 'Bengkel B', 'Bengkel C', 'Bengkel D', 'Bengkel E');

        for ($i = 1; $i < count($bengkel); $i++) {
            DB::table('bengkel')->insert([
                'bengkel_name' => $bengkel[$i - 1],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
