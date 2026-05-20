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
            ['name' => 'Super Admin', 'password' => Hash::make('password')]
        );
        $admin->assignRole('super_admin');

        $akademik = User::firstOrCreate(
            ['email' => 'akademik@admin.com'],
            ['name' => 'Akademik', 'password' => Hash::make('password')]
        );
        $akademik->assignRole('user');

        $guru = User::firstOrCreate(
            ['email' => 'guru@admin.com'],
            ['name' => 'Guru', 'password' => Hash::make('password')]
        );
        $guru->assignRole('user');

        $siswa = User::firstOrCreate(
            ['email' => 'siswa@admin.com'],
            ['name' => 'Siswa', 'password' => Hash::make('password')]
        );
        $siswa->assignRole('user');

        $orangtua = User::firstOrCreate(
            ['email' => 'orangtua@admin.com'],
            ['name' => 'Orang Tua', 'password' => Hash::make('password')]
        );
        $orangtua->assignRole('user');
    }
}
