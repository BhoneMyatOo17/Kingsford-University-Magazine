<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Staff;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    private array $members = [
        [
            'name'       => 'Aye Myat Thiri Mon',
            'email'      => 'ayemyat@ksf.it.com',
            'password'   => 'Ayemyat1!',
            'mc_email'   => 'ayemyat.mc@ksf.it.com',
            'faculty'    => 'IS',
        ],
        [
            'name'       => 'Aye Thandar Aung',
            'email'      => 'ayethandar@ksf.it.com',
            'password'   => 'Ayethandar1!',
            'mc_email'   => 'ayethandar.mc@ksf.it.com',
            'faculty'    => 'FT',
        ],
        [
            'name'       => 'Bhone Myat Oo',
            'email'      => 'bhone@ksf.it.com',
            'password'   => 'Bhonemyat1!',
            'mc_email'   => 'bhone.mc@ksf.it.com',
            'faculty'    => 'SE',
        ],
        [
            'name'       => 'Kyi Phyu Thant',
            'email'      => 'kyi@ksf.it.com',
            'password'   => 'Kyiphyu1!',
            'mc_email'   => 'kyi.mc@ksf.it.com',
            'faculty'    => 'CYB',
        ],
        [
            'name'       => 'Min Thet Khine',
            'email'      => 'min@ksf.it.com',
            'password'   => 'Minthet1!',
            'mc_email'   => 'min.mc@ksf.it.com',
            'faculty'    => 'CC',
        ],
        [
            'name'       => 'Myat Shun Lei Zaw',
            'email'      => 'myat@ksf.it.com',
            'password'   => 'Myatshun1!',
            'mc_email'   => 'myat.mc@ksf.it.com',
            'faculty'    => 'DSA',
        ],
        [
            'name'       => 'Poe Waddy Khin Soe Lwin',
            'email'      => 'poe@ksf.it.com',
            'password'   => 'Poewaddy1!',
            'mc_email'   => 'poe.mc@ksf.it.com',
            'faculty'    => 'BIT',
        ],
        [
            'name'       => 'Yoon Thiri',
            'email'      => 'yoon@ksf.it.com',
            'password'   => 'Yoonthiri1!',
            'mc_email'   => 'yoon.mc@ksf.it.com',
            'faculty'    => 'CN',
        ],
    ];

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

    public function run(): void
    {
        foreach ($this->members as $member) {
            $faculty = Faculty::where('code', $member['faculty'])->first();

            // --- Student ---
            $studentUser = User::firstOrCreate(
                ['email' => $member['email']],
                [
                    'name'                 => $member['name'],
                    'password'             => Hash::make($member['password']),
                    'is_active'            => true,
                    'password_changed_at'  => now(),
                    'must_change_password' => false,
                    'email_verified_at'    => now(),
                ]
            );

            if (!$studentUser->hasRole('student')) {
                $studentUser->assignRole('student');
            }

            if (!Student::where('user_id', $studentUser->id)->exists()) {
                $studentId = $this->generateId('KSF', fn($id) => Student::where('student_id', $id)->exists());

                Student::create([
                    'user_id'         => $studentUser->id,
                    'student_id'      => $studentId,
                    'faculty_id'      => $faculty?->id,
                    'program'         => $faculty?->activePrograms()->where('level', 'undergraduate')->inRandomOrder()->first()?->name ?? 'B.Sc ' . $faculty?->name,
                    'enrollment_year' => now()->year,
                    'study_level'     => 'undergraduate',
                    'phone'           => null,
                    'address'         => null,
                ]);
            }

            $this->command->info("Student: {$member['name']} ({$member['email']})");

            // --- Coordinator ---
            $coordUser = User::firstOrCreate(
                ['email' => $member['mc_email']],
                [
                    'name'                 => $member['name'],
                    'password'             => Hash::make($member['password']),
                    'is_active'            => true,
                    'password_changed_at'  => now(),
                    'must_change_password' => false,
                    'email_verified_at'    => now(),
                ]
            );

            if (!$coordUser->hasRole('marketing_coordinator')) {
                $coordUser->assignRole('marketing_coordinator');
            }

            if (!Staff::where('user_id', $coordUser->id)->exists()) {
                $staffId = $this->generateId('STF', fn($id) => Staff::where('staff_id', $id)->exists());

                Staff::create([
                    'user_id'         => $coordUser->id,
                    'staff_id'        => $staffId,
                    'faculty_id'      => $faculty?->id,
                    'department'      => $faculty?->name,
                    'position'        => 'Marketing Coordinator',
                    'hire_date'       => now()->subYears(2),
                    'phone'           => null,
                    'office_location' => null,
                ]);
            }

            $this->command->info("Coordinator: {$member['name']} ({$member['mc_email']})");
        }
    }
}
