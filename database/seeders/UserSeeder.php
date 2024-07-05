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
            'user_nip' => "42638476327846",
            'user_fullname' => "Kabeng",
            'username' => "kabeng",
            'email' => "yogaaawi12345@gmail.com",
            "password" => bcrypt("kabeng123"),
            'user_telephone' => "47673647236474",
            'user_age' => 30,
            'role_id' => 2,
            "created_at" => now(),
            "updated_at" => now(),
        ]);
        User::create([
            'user_nip' => "8768724687236",
            'user_fullname' => "kadep",
            'username' => "kadep",
            'email' => "yogaaawi12345@gmail.com",
            "password" => bcrypt("kadep123"),
            'user_telephone' => "23784826487634",
            'user_age' => 30,
            'role_id' => 3,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        User::create([
            'user_nip' => "35824834786",
            'user_fullname' => "kemenpro",
            'username' => "kemenpro",
            'email' => "yogaaawi12345@gmail.com",
            "password" => bcrypt("kemenpro123"),
            'user_telephone' => "432876786427642",
            'user_age' => 30,
            'role_id' => 4,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        User::create([
            'user_nip' => "42384784876264",
            'user_fullname' => "pegawai",
            'username' => "pegawai",
            'email' => "yogaaawi12345@gmail.com",
            "password" => bcrypt("pegawai123"),
            'user_telephone' => "487389478974134",
            'user_age' => 30,
            'role_id' => 5,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

    }
}
