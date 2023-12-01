<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'admin',
            'username' => 'admin123',
            'password' => 'admin'
        ]);

        $user1->assignRole('Admin');

        $user2 = User::create([
            'name' => 'bambang',
            'username' => 'bambang123',
            'password' => 'bambang'
        ]);

        $user2->assignRole('Dosen');
    }
}
