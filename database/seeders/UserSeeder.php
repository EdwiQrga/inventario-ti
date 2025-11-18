<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Edwin Quiroga',
            'email' => 'edwin_quiroga@upatlautla.edu.mx',
            'password' => bcrypt('Kali1417'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Promenal',
            'email' => 'sanchez.osva1417@gmail.com',
            'password' => bcrypt('User14'),
            'role' => 'user',
        ]);
    }
}