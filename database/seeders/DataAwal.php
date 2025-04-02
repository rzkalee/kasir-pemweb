<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DataAwal extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@kasir.com',
                'password' => bcrypt('12345678'),
                'role' => 'admin',
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@kasir.com',
                'password' => bcrypt('12345678'),
                'role' => 'kasir',
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@kasir.com',
                'password' => bcrypt('12345678'),
                'role' => 'manager',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}