<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proyek = array('Proyek 1', 'Proyek 2', 'Proyek 3', 'Proyek 4', 'Proyek 5');

        for ($i = 0; $i < count($proyek); $i++) {
            DB::table('proyek')->insert([
                'proyek_name' => $proyek[$i],
                'pj_proyek' => rand(3, 4),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
