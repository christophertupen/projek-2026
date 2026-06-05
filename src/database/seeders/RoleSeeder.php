<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'super_admin']);
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'akademik']);
        $guru = Role::firstOrCreate(['name' => 'guru']);
        Role::firstOrCreate(['name' => 'siswa']);
        Role::firstOrCreate(['name' => 'orangtua']);

        $guruPermissions = [
            'view_any_material',
            'view_material',
            'create_material',
            'update_material',
            'delete_material',
            'delete_any_material',
            'view_any_question::bank',
            'view_question::bank',
            'create_question::bank',
            'update_question::bank',
            'delete_question::bank',
            'delete_any_question::bank',
            'view_any_quiz',
            'view_quiz',
            'create_quiz',
            'update_quiz',
            'delete_quiz',
            'delete_any_quiz',
            'view_any_question',
            'view_question',
            'create_question',
            'update_question',
            'delete_question',
            'delete_any_question',
        ];

        foreach ($guruPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $guru->syncPermissions($guruPermissions);
    }
}
