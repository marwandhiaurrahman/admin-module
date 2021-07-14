<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user-show',
            'user-manage',
            'role-show',
            'role-manage',
            'siswa-show',
            'siswa-manage',
        ];
        $roles = [
            'Siswa',
            'Guru',
        ];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
