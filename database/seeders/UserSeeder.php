<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_nip' => "1234567890",
            'user_fullname' => "Admin",
            'username' => "admin",
            'email' => "admin@gmail.com",
            "password" => bcrypt("admin12345"),
            'user_telephone' => "081234567890",
            'user_age' => 30,
            'role_id' => 1,
            "created_at" => now(),
            "updated_at" => now(),
        ]);
        User::create([
            'user_nip' => "123456789",
            'user_fullname' => "Kepala Bengkel",
            'username' => "kabeng",
            'email' => "kabeng@gmail.com",
            "password" => bcrypt("admin12345"),
            'user_telephone' => "081234567890",
            'user_age' => 30,
            'role_id' => 2,
            "created_at" => now(),
            "updated_at" => now(),
        ]);
        User::create([
            'user_nip' => "12345678",
            'user_fullname' => "Kepala Departemen",
            'username' => "kepaladep",
            'email' => "kepaladep@gmail.com",
            "password" => bcrypt("admin12345"),
            'user_telephone' => "081234567890",
            'user_age' => 30,
            'role_id' => 3,
            "created_at" => now(),
            "updated_at" => now(),
        ]);
        User::create([
            'user_nip' => "1234567",
            'user_fullname' => "Kepala Manager Proyek",
            'username' => "kemenpro",
            'email' => "kemenpro@gmail.com",
            "password" => bcrypt("admin12345"),
            'user_telephone' => "081234567890",
            'user_age' => 30,
            'role_id' => 4,
            "created_at" => now(),
            "updated_at" => now(),
        ]);
        User::create([
            'user_nip' => "123456",
            'user_fullname' => "Pegawai",
            'username' => "pegawai",
            'email' => "pegawai@gmail.com",
            "password" => bcrypt("admin12345"),
            'user_telephone' => "081234567890",
            'user_age' => 30,
            'role_id' => 5,
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }
}
