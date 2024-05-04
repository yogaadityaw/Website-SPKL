<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departemen = array('Departemen 1', 'Departemen 2', 'Departemen 3', 'Departemen 4', 'Departemen 5');

        for ($i = 0; $i < count($departemen); $i++) {
            DB::table('departemen')->insert([
                'departemen_name' => $departemen[$i],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
