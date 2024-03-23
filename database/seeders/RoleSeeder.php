<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = array('Admin', 'Kepala Bengkel', "Kepala Departemen", "Kepala Manajer Proyek", "Pegawai", "User");
        for ($i = 1; $i <= count($role); $i++) {
            DB::table('role')->insert([
                'id_role' => $i,
                'role_name' => $role[$i - 1]
            ]);
        }
    }
}
