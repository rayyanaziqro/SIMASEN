<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dosen::create([
            'nama' => 'Drs Adi Hidayatulah, S,Kom',
            'nidn' => fake()->randomNumber(5, true),
            'nip' => fake()->randomNumber(9, true),
            'pendidikan' => 'S2 Management',
            'pangkat' => 'Pembina Utama',
            'password' => bcrypt('adihidayat')
        ]);
        Dosen::create([
            'nama' => 'Dr Aminulah, S,Pd',
            'nidn' => fake()->randomNumber(5, true),
            'nip' => fake()->randomNumber(9, true),
            'pendidikan' => 'S2 Pendidikan',
            'pangkat' => 'Pembina TKI',
            'password' => 'aminulah'
        ]);
        Dosen::create([
            'nama' => 'Sri Mulyani, S,Pd S,Kom',
            'nidn' => fake()->randomNumber(5, true),
            'nip' => fake()->randomNumber(9, true),
            'pendidikan' => 'S2 Sastra Inggris',
            'pangkat' => 'Pembina TKI',
            'password' => 'srimulyani'
        ]);
    }
}
