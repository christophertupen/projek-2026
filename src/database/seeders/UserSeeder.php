<?php

namespace Database\Seeders;

use App\Models\User;
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
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );
        $admin->syncRoles(['admin']);

        $akademik = User::firstOrCreate(
            ['email' => 'akademik@admin.com'],
            [
                'name' => 'Akademik',
                'password' => Hash::make('password'),
                'nip' => 'AKD001',
            ]
        );
        $akademik->syncRoles(['akademik']);

        $guru = User::firstOrCreate(
            ['email' => 'guru@admin.com'],
            [
                'name' => 'Guru',
                'password' => Hash::make('password'),
                'nip' => 'GR001',
            ]
        );
        $guru->syncRoles(['guru']);

        $orangtua = User::firstOrCreate(
            ['email' => 'orangtua@admin.com'],
            [
                'name' => 'Orang Tua',
                'password' => Hash::make('password'),
            ]
        );
        $orangtua->syncRoles(['orangtua']);

        $siswa = User::firstOrCreate(
            ['email' => 'siswa@admin.com'],
            [
                'name' => 'Siswa',
                'password' => Hash::make('password'),
                'nis' => 'SIS001',
                'parent_id' => $orangtua->id,
            ]
        );
        $siswa->syncRoles(['siswa']);
    }
}