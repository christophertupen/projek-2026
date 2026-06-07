<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $akademik = Role::firstOrCreate([
            'name' => 'akademik',
            'guard_name' => 'web',
        ]);

        $guru = Role::firstOrCreate([
            'name' => 'guru',
            'guard_name' => 'web',
        ]);

        $siswa = Role::firstOrCreate([
            'name' => 'siswa',
            'guard_name' => 'web',
        ]);

        $orangtua = Role::firstOrCreate([
            'name' => 'orangtua',
            'guard_name' => 'web',
        ]);

        $permissions = [
            // User & role administration
            'view_any_user',
            'view_user',
            'create_user',
            'update_user',
            'delete_user',
            'delete_any_user',
            'view_any_role',
            'view_role',
            'create_role',
            'update_role',
            'delete_role',
            'delete_any_role',

            // Activity log
            'view_any_activity',
            'view_activity',
            'create_activity',
            'update_activity',
            'delete_activity',
            'delete_any_activity',

            // Mata pelajaran
            'view_any_subject',
            'view_subject',
            'create_subject',
            'update_subject',
            'delete_subject',
            'delete_any_subject',

            // Materi
            'view_any_material',
            'view_material',
            'create_material',
            'update_material',
            'delete_material',
            'delete_any_material',

            // Bank soal
            'view_any_question::bank',
            'view_question::bank',
            'create_question::bank',
            'update_question::bank',
            'delete_question::bank',
            'delete_any_question::bank',

            // Quiz
            'view_any_quiz',
            'view_quiz',
            'create_quiz',
            'update_quiz',
            'delete_quiz',
            'delete_any_quiz',

            // Soal quiz
            'view_any_question',
            'view_question',
            'create_question',
            'update_question',
            'delete_question',
            'delete_any_question',

            // Opsi jawaban
            'view_any_question::option',
            'view_question::option',
            'create_question::option',
            'update_question::option',
            'delete_question::option',
            'delete_any_question::option',

            // Pengerjaan quiz
            'view_any_quiz::attempt',
            'view_quiz::attempt',
            'create_quiz::attempt',
            'update_quiz::attempt',
            'delete_quiz::attempt',
            'delete_any_quiz::attempt',

            // Permission konseptual untuk fitur siswa/orangtua
            'view_learning_material',
            'view_available_quiz',
            'take_quiz',
            'view_own_score',
            'view_child_score',
            'view_child_progress',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $admin->syncPermissions($permissions);

        $akademik->syncPermissions([
            'view_any_subject',
            'view_subject',
            'create_subject',
            'update_subject',
            'delete_subject',
            'delete_any_subject',
        ]);

        $guru->syncPermissions([
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

            'view_any_question::option',
            'view_question::option',
            'create_question::option',
            'update_question::option',
            'delete_question::option',
            'delete_any_question::option',
        ]);

        $siswa->syncPermissions([
            'view_any_material',
            'view_material',
            'view_any_quiz::attempt',
            'view_quiz::attempt',
            'view_learning_material',
            'view_available_quiz',
            'take_quiz',
            'view_own_score',
        ]);

        $orangtua->syncPermissions([
            'view_any_material',
            'view_material',
            'view_any_quiz::attempt',
            'view_quiz::attempt',
            'view_child_score',
            'view_child_progress',
        ]);
    }
}
