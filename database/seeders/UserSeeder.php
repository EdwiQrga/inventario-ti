<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Usuario',
            'email' => 'admin@example.com',
            'password' => bcrypt('Quirog17.'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Usuario Normal',
            'email' => 'user@example.com',
            'password' => bcrypt('User14'),
            'role' => 'user',
        ]);
    }
}