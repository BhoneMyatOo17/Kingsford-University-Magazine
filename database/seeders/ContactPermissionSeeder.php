<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ContactPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'view contacts',
            'manage contacts',
            'delete contacts',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        // Admin gets all permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo($permissions);

        // Manager gets view and manage permissions
        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $managerRole->givePermissionTo(['view contacts', 'manage contacts']);

        // Marketing Coordinator gets view permission only
        $coordinatorRole = Role::firstOrCreate(['name' => 'coordinator']);
        $coordinatorRole->givePermissionTo('view contacts');
    }
}