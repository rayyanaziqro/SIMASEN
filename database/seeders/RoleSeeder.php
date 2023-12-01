<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Admin',
            'guard_name' => config('auth.defaults.guard')
        ]);
        Role::create([
            'name' => 'Dosen',
            'guard_name' => config('auth.defaults.guard')
        ]);
    }
}
