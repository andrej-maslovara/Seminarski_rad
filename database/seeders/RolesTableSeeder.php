<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);
        $bloggerRole = Role::create(['name' => 'blogger']);

        $adminPermission = Permission::create(['name' => 'admin']);
        $editorPermission = Permission::create(['name' => 'editor']);
        $userPermission = Permission::create(['name' => 'user']);

        $adminRole->givePermissionTo($adminPermission);
        $editorRole->givePermissionTo($editorPermission);
        $bloggerRole->givePermissionTo($userPermission);

        $this->command->info('Roles seeded successfully.');
    }
}
