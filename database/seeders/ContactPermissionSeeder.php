<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ContactPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'view contacts',
            'manage contacts',
            'delete contacts',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Admin gets all permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo($permissions);

        // Manager gets view and manage permissions
        $managerRole = Role::firstOrCreate(['name' => 'marketing_manager', 'guard_name' => 'web']);
        $managerRole->givePermissionTo(['view contacts', 'manage contacts']);

        // Marketing Coordinator gets view permission only
        $coordinatorRole = Role::firstOrCreate(['name' => 'marketing_coordinator', 'guard_name' => 'web']);
        $coordinatorRole->givePermissionTo('view contacts');

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}