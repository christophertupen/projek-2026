<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            ['name' => 'Admin', 'password' => Hash::make('password')]
        );
        $admin->assignRole('admin');

        $akademik = User::firstOrCreate(
            ['email' => 'akademik@admin.com'],
            ['name' => 'Akademik', 'password' => Hash::make('password')]
        );
        $akademik->assignRole('akademik');

        $guru = User::firstOrCreate(
            ['email' => 'guru@admin.com'],
            ['name' => 'Guru', 'password' => Hash::make('password')]
        );
        $guru->assignRole('guru');

        $siswa = User::firstOrCreate(
            ['email' => 'siswa@admin.com'],
            ['name' => 'Siswa', 'password' => Hash::make('password')]
        );
        $siswa->assignRole('siswa');

        $orangtua = User::firstOrCreate(
            ['email' => 'orangtua@admin.com'],
            ['name' => 'Orang Tua', 'password' => Hash::make('password')]
        );
        $orangtua->assignRole('orangtua');
    }
}
