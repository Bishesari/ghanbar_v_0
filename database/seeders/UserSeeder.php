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
            'user_name' => 'Yasser',
            'password' => '123456',
            'role' => 'admin',
        ]);
        User::create([
            'user_name' => 'Mahdi',
            'password' => '123456',
            'role' => 'warehouse',
        ]);
        User::create([
            'user_name' => 'Sami',
            'password' => '123456',
            'role' => 'visitor',
        ]);
    }
}
