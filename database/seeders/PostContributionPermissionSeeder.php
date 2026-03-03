<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PostContributionPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // Posts
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',

            // Contributions
            'view contributions',
            'create contributions',
            'edit contributions',
            'delete contributions',
            'comment contributions',
            'approve contributions',
            'report contributions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->givePermissionTo($permissions);

        $manager = Role::firstOrCreate(['name' => 'marketing_manager', 'guard_name' => 'web']);
        $manager->givePermissionTo([
            'view posts',
            'view contributions',
        ]);

        $coordinator = Role::firstOrCreate(['name' => 'marketing_coordinator', 'guard_name' => 'web']);
        $coordinator->givePermissionTo([
            'view posts',
            'view contributions',
            'comment contributions',
            'approve contributions',
            'report contributions',
        ]);

        $student = Role::firstOrCreate(['name' => 'student', 'guard_name' => 'web']);
        $student->givePermissionTo([
            'view posts',
            'create contributions',
            'edit contributions',
            'delete contributions',
            'report contributions',
        ]);

        $guest = Role::firstOrCreate(['name' => 'guest', 'guard_name' => 'web']);
        $guest->givePermissionTo([
            'view posts',
        ]);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
