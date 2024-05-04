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
    }
}
