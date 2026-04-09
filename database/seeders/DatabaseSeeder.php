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
        $this->createDefaultGuests();

        $this->call([
            MemberSeeder::class,
            DemoDataSeeder::class,
        ]);
    }

    private function generateId(string $prefix, callable $existsCheck): string
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        do {
            $suffix = '';
            for ($i = 0; $i < 4; $i++) {
                $suffix .= $chars[random_int(0, strlen($chars) - 1)];
            }
            $id = $prefix . $suffix;
        } while ($existsCheck($id));

        return $id;
    }

    private function createDefaultAdmin(): void
    {
        $admin = \App\Models\User::create([
            'name'                 => 'Administrator',
            'email'                => 'admin@ksf.it.com',
            'password'             => \Illuminate\Support\Facades\Hash::make('Admin1!'),
            'is_active'            => true,
            'password_changed_at'  => now(),
            'must_change_password' => false,
            'email_verified_at'    => now(),
        ]);

        $admin->assignRole('admin');

        $staffId = $this->generateId('STF', fn($id) => \App\Models\Staff::where('staff_id', $id)->exists());

        \App\Models\Staff::create([
            'user_id'         => $admin->id,
            'staff_id'        => $staffId,
            'faculty_id'      => null,
            'department'      => 'Administration',
            'position'        => 'System Administrator',
            'hire_date'       => now(),
            'phone'           => null,
            'office_location' => 'Admin Building',
        ]);

        $this->command->info('Admin created: admin@ksf.it.com / Admin1!');
    }

    private function createDefaultStudent(): void
    {
        $faculty = \App\Models\Faculty::where('code', 'CS')->first();

        $student = \App\Models\User::create([
            'name'                 => 'Student User',
            'email'                => 'student@ksf.it.com',
            'password'             => \Illuminate\Support\Facades\Hash::make('Student1!'),
            'is_active'            => true,
            'password_changed_at'  => now(),
            'must_change_password' => false,
            'email_verified_at'    => now(),
        ]);

        $student->assignRole('student');

        $studentId = $this->generateId('KSF', fn($id) => \App\Models\Student::where('student_id', $id)->exists());

        \App\Models\Student::create([
            'user_id'         => $student->id,
            'student_id'      => $studentId,
            'faculty_id'      => $faculty?->id,
            'program'         => 'B.Sc Computer Science',
            'enrollment_year' => now()->year,
            'study_level'     => 'undergraduate',
            'phone'           => null,
            'address'         => null,
        ]);

        $this->command->info('Student created: student@ksf.it.com / Student1!');
    }

    private function createDefaultCoordinator(): void
    {
        $faculty = \App\Models\Faculty::where('code', 'CS')->first();

        $coordinator = \App\Models\User::create([
            'name'                 => 'Marketing Coordinator',
            'email'                => 'coord@ksf.it.com',
            'password'             => \Illuminate\Support\Facades\Hash::make('Coordinator1!'),
            'is_active'            => true,
            'password_changed_at'  => now(),
            'must_change_password' => false,
            'email_verified_at'    => now(),
        ]);

        $coordinator->assignRole('marketing_coordinator');

        $staffId = $this->generateId('STF', fn($id) => \App\Models\Staff::where('staff_id', $id)->exists());

        \App\Models\Staff::create([
            'user_id'         => $coordinator->id,
            'staff_id'        => $staffId,
            'faculty_id'      => $faculty?->id,
            'department'      => 'Computer Science',
            'position'        => 'Marketing Coordinator',
            'hire_date'       => now(),
            'phone'           => null,
            'office_location' => null,
        ]);

        $this->command->info('Coordinator created: coord@ksf.it.com / Coordinator1!');
    }

    private function createDefaultManager(): void
    {
        $manager = \App\Models\User::create([
            'name'                 => 'Marketing Manager',
            'email'                => 'manager@ksf.it.com',
            'password'             => \Illuminate\Support\Facades\Hash::make('Manager1!'),
            'is_active'            => true,
            'password_changed_at'  => now(),
            'must_change_password' => false,
            'email_verified_at'    => now(),
        ]);

        $manager->assignRole('marketing_manager');

        $staffId = $this->generateId('STF', fn($id) => \App\Models\Staff::where('staff_id', $id)->exists());

        \App\Models\Staff::create([
            'user_id'         => $manager->id,
            'staff_id'        => $staffId,
            'faculty_id'      => null,
            'department'      => 'Marketing',
            'position'        => 'Marketing Manager',
            'hire_date'       => now(),
            'phone'           => null,
            'office_location' => null,
        ]);

        $this->command->info('Manager created: manager@ksf.it.com / Manager1!');
    }

    private function createDefaultGuests(): void
    {
        $csFaculty  = \App\Models\Faculty::where('code', 'CS')->first();
        $dsaFaculty = \App\Models\Faculty::where('code', 'DSA')->first();

        $guests = [
            [
                'name'       => 'Guest User',
                'email'      => 'guest@ksf.it.com',
                'password'   => 'Guest1!',
                'faculty_id' => $csFaculty?->id,
            ],
            [
                'name'       => 'Guest User 2',
                'email'      => 'guest2@ksf.it.com',
                'password'   => 'Guest2!',
                'faculty_id' => $dsaFaculty?->id,
            ],
        ];

        foreach ($guests as $guestData) {
            $guest = \App\Models\User::create([
                'name'                 => $guestData['name'],
                'email'                => $guestData['email'],
                'password'             => \Illuminate\Support\Facades\Hash::make($guestData['password']),
                'is_active'            => true,
                'password_changed_at'  => now(),
                'must_change_password' => false,
                'email_verified_at'    => now(),
            ]);

            $guest->assignRole('guest');

            $this->command->info("Guest created: {$guestData['email']} / {$guestData['password']}");
        }

        $test = \App\Models\User::create([
            'name'                 => 'Test Register',
            'email'                => 'test@ksf.it.com',
            'password'             => \Illuminate\Support\Facades\Hash::make('Test1234!'),
            'is_active'            => true,
            'password_changed_at'  => now(),
            'must_change_password' => false,
            'email_verified_at'    => now(),
        ]);

        $this->command->info('Test user created: test@ksf.it.com / Test1234!');
    }
}
