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
                'name' => 'Siti',
                'email' => 'kasirsiti@kasir.com',
                'password' => bcrypt('12345678'),
                'role' => 'kasir',
            ],
            [
                'name' => 'Walid',
                'email' => 'kasirwalid@kasir.com',
                'password' => bcrypt('12345678'),
                'role' => 'kasir',
            ],
            [
                'name' => 'Rizka Fatihah',
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