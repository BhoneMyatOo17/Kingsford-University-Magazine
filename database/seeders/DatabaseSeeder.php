<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            ContactPermissionSeeder::class,
            PostContributionPermissionSeeder::class,
            FacultySeeder::class,
        ]);

        $this->createDefaultAdmin();
        $this->createDefaultStudent();
        $this->createDefaultCoordinator();
        $this->createDefaultManager();
    }

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

        \App\Models\Staff::create([
            'user_id' => $admin->id,
            'staff_id' => 'ADM001',
            'faculty_id' => null,
            'department' => 'Administration',
            'position' => 'System Administrator',
            'hire_date' => now(),
            'phone' => null,
            'office_location' => 'Admin Building',
        ]);

        $this->command->info('Admin created: admin@ksf.it.com / Admin1!');
    }

    private function createDefaultStudent(): void
    {
        $faculty = \App\Models\Faculty::where('code', 'CS')->first();

        $student = \App\Models\User::create([
            'name' => 'Student User',
            'email' => 'student@ksf.it.com',
            'password' => \Illuminate\Support\Facades\Hash::make('Student1!'),
            'is_active' => true,
            'password_changed_at' => now(),
            'must_change_password' => false,
            'email_verified_at' => now(),
        ]);

        $student->assignRole('student');

        \App\Models\Student::create([
            'user_id' => $student->id,
            'student_id' => 'STU001',
            'faculty_id' => $faculty?->id,
            'program' => 'B.Sc Computer Science',
            'enrollment_year' => now()->year,
            'study_level' => 'undergraduate',
            'phone' => null,
            'address' => null,
        ]);

        $this->command->info('Student created: student@ksf.it.com / Student1!');
    }

    private function createDefaultCoordinator(): void
    {
        $faculty = \App\Models\Faculty::where('code', 'CS')->first();

        $coordinator = \App\Models\User::create([
            'name' => 'Marketing Coordinator',
            'email' => 'coord@ksf.it.com',
            'password' => \Illuminate\Support\Facades\Hash::make('Coordinator1!'),
            'is_active' => true,
            'password_changed_at' => now(),
            'must_change_password' => false,
            'email_verified_at' => now(),
        ]);

        $coordinator->assignRole('marketing_coordinator');

        \App\Models\Staff::create([
            'user_id' => $coordinator->id,
            'staff_id' => 'COORD001',
            'faculty_id' => $faculty?->id,
            'department' => 'Computer Science',
            'position' => 'Marketing Coordinator',
            'hire_date' => now(),
            'phone' => null,
            'office_location' => null,
        ]);

        $this->command->info('Coordinator created: coord@ksf.it.com / Coordinator1!');
    }

    private function createDefaultManager(): void
    {
        $manager = \App\Models\User::create([
            'name' => 'Marketing Manager',
            'email' => 'manager@ksf.it.com',
            'password' => \Illuminate\Support\Facades\Hash::make('Manager1!'),
            'is_active' => true,
            'password_changed_at' => now(),
            'must_change_password' => false,
            'email_verified_at' => now(),
        ]);

        $manager->assignRole('marketing_manager');

        \App\Models\Staff::create([
            'user_id' => $manager->id,
            'staff_id' => 'MGR001',
            'faculty_id' => null,
            'department' => 'Marketing',
            'position' => 'Marketing Manager',
            'hire_date' => now(),
            'phone' => null,
            'office_location' => null,
        ]);

        $this->command->info('Manager created: manager@ksf.it.com / Manager1!');
    }
}
