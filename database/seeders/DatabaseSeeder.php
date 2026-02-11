<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles first (required for user creation)
        $this->call([
            RoleSeeder::class,
            FacultySeeder::class,
            // Add more seeders here as needed
        ]);

        // Optionally create a default admin user
     $this->createDefaultAdmin();
    }

    /**
     * Create a default admin user for initial setup
     */
    private function createDefaultAdmin(): void
    {
        $admin = \App\Models\User::create([
            'name' => 'Administrator',
            'email' => 'admin@ksf.it.com',
            'password' => \Illuminate\Support\Facades\Hash::make('Admin1!'),
            'is_active' => true,
            'password_changed_at' => now(),
            'must_change_password' => false,
            'email_verified_at' => now(),
        ]);

        $admin->assignRole('admin');

        // Create admin staff profile
        \App\Models\Staff::create([
            'user_id' => $admin->id,
            'staff_id' => 'ADM001',
            'faculty_id' => null, // Admin doesn't need faculty
            'department' => 'Administration',
            'position' => 'System Administrator',
            'hire_date' => now(),
            'phone' => null,
            'office_location' => 'Admin Building',
        ]);

        $this->command->info('Default admin created: admin@ksf.it.com / Admin1!');
    }
}