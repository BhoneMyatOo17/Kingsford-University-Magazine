<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Comment;
use App\Models\Contribution;
use App\Models\Faculty;
use App\Models\Magazine;
use App\Models\Post;
use App\Models\Staff;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
  private string $loremShort = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
  private string $loremLong  = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

  private array $firstNames = [
    'James',
    'Aisha',
    'Liam',
    'Sofia',
    'Noah',
    'Priya',
    'Ethan',
    'Mei',
    'Lucas',
    'Fatima',
    'Oliver',
    'Yuna',
    'Marcus',
    'Layla',
    'Daniel',
    'Zara',
    'Ryan',
    'Nadia',
    'Aaron',
    'Hana',
    'Kevin',
    'Sara',
    'Jason',
    'Elena',
    'Tyler',
    'Amara',
    'Nathan',
    'Chloe',
    'Adam',
    'Ingrid',
    'Samuel',
    'Diana',
    'Leo',
    'Nina',
    'Felix',
    'Alicia',
    'Hugo',
    'Leila',
    'Oscar',
    'Maya',
    'Ivan',
    'Selin',
    'Kai',
    'Rosa',
    'Erik',
    'Yara',
    'Julian',
    'Nora',
    'Andre',
    'Lena',
  ];

  private array $lastNames = [
    'Carter',
    'Patel',
    'Nguyen',
    'Hassan',
    'Kim',
    'Okafor',
    'Muller',
    'Santos',
    'Tanaka',
    'Ahmed',
    'Williams',
    'Chen',
    'Park',
    'Rivera',
    'Johansson',
    'Ali',
    'Fernandez',
    'Singh',
    'Andersen',
    'Kowalski',
    'Reyes',
    'Ibrahim',
    'Nakamura',
    'Osei',
    'Petrov',
    'Moreau',
    'Khan',
    'Yilmaz',
    'Dubois',
    'Mensah',
    'Kofi',
    'Herrera',
    'Yamamoto',
    'Bakr',
    'Lindqvist',
    'Dlamini',
    'Rashid',
    'Sato',
    'Martins',
    'Eriksson',
  ];

  private array $coordinatorFirstNames = [
    'Margaret',
    'David',
    'Priscilla',
    'Raymond',
    'Sophia',
    'Bernard',
    'Caroline',
    'Patrick',
    'Vivienne',
    'George',
  ];

  private array $coordinatorLastNames = [
    'Fletcher',
    'Okonkwo',
    'Hartmann',
    'Delacroix',
    'Yamada',
    'Abramowitz',
    'Nkrumah',
    'Svensson',
    'Castillo',
    'Whitfield',
  ];

  private array $usedNames = [];
  private int $coordIndex  = 0;

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

  private function fakeName(): string
  {
    $attempts = 0;
    do {
      $name     = $this->firstNames[array_rand($this->firstNames)] . ' ' . $this->lastNames[array_rand($this->lastNames)];
      $attempts++;
    } while (in_array($name, $this->usedNames) && $attempts < 100);

    $this->usedNames[] = $name;
    return $name;
  }

  private function fakeCoordinatorName(): string
  {
    $first = $this->coordinatorFirstNames[$this->coordIndex % count($this->coordinatorFirstNames)];
    $last  = $this->coordinatorLastNames[$this->coordIndex % count($this->coordinatorLastNames)];
    $this->coordIndex++;
    return "$first $last";
  }

  private function nameToEmail(string $name, string $suffix = ''): string
  {
    $slug  = strtolower(str_replace([' ', "'"], ['.', ''], $name));
    $slug  = preg_replace('/[^a-z0-9.]/', '', $slug);
    $base  = $slug . ($suffix ? ".{$suffix}" : '') . '@ksf.it.com';
    $email = $base;
    $i     = 2;
    while (User::where('email', $email)->exists()) {
      $email = $slug . ($suffix ? ".{$suffix}" : '') . $i . '@ksf.it.com';
      $i++;
    }
    return $email;
  }

  public function run(): void
  {
    $this->command->info('Seeding academic years...');
    $academicYears = $this->seedAcademicYears();

    $this->command->info('Seeding magazines...');
    $this->seedMagazines($academicYears);

    $this->command->info('Seeding coordinators per faculty...');
    $this->seedCoordinators();

    $this->command->info('Seeding posts and contributions...');
    $this->seedPostsAndContributions($academicYears);

    $this->command->info('Demo data seeded successfully.');
  }

  private function seedAcademicYears(): array
  {
    $years = [
      [
        'name'               => '2023',
        'year'               => 2023,
        'closure_date'       => '2023-03-31',
        'final_closure_date' => '2023-04-30',
        'is_active'          => false,
        'description'        => 'Academic year 2022-2023.',
      ],
      [
        'name'               => '2024',
        'year'               => 2024,
        'closure_date'       => '2024-03-31',
        'final_closure_date' => '2024-04-30',
        'is_active'          => false,
        'description'        => 'Academic year 2023-2024.',
      ],
      [
        'name'               => '2025',
        'year'               => 2025,
        'closure_date'       => '2025-03-31',
        'final_closure_date' => '2025-04-30',
        'is_active'          => false,
        'description'        => 'Academic year 2024-2025.',
      ],
      [
        'name'               => '2026',
        'year'               => 2026,
        'closure_date'       => '2026-06-30',
        'final_closure_date' => '2026-07-31',
        'is_active'          => true,
        'description'        => 'Current academic year 2025-2026.',
      ],
    ];

    $result = [];
    foreach ($years as $data) {
      $result[$data['year']] = AcademicYear::firstOrCreate(
        ['year' => $data['year']],
        $data
      );
    }
    return $result;
  }

  private function seedMagazines(array $academicYears): void
  {
    $admin = User::role('admin')->first();

    $titles = [
      2023 => 'Kingsford Annual Magazine 2023',
      2024 => 'Kingsford Annual Magazine 2024',
      2025 => 'Kingsford Annual Magazine 2025',
      2026 => 'Kingsford Annual Magazine 2026',
    ];

    foreach ($academicYears as $year => $academicYear) {
      Magazine::firstOrCreate(
        ['academic_year_id' => $academicYear->id],
        [
          'created_by'     => $admin?->id,
          'title'          => $titles[$year],
          'description'    => "The annual Kingsford University magazine for the {$academicYear->name}.",
          'published_date' => "{$year}-06-01",
          'content'        => $this->loremLong,
          'view_count'     => rand(50, 300),
        ]
      );
    }
  }

  private function seedCoordinators(): void
  {
    $faculties = Faculty::all();

    foreach ($faculties as $faculty) {
      $exists = Staff::where('faculty_id', $faculty->id)
        ->whereHas('user', fn($q) => $q->role('marketing_coordinator'))
        ->exists();

      if ($exists) continue;

      $name  = $this->fakeCoordinatorName();
      $email = $this->nameToEmail($name, 'coord');

      $user = User::create([
        'name'                 => $name,
        'email'                => $email,
        'password'             => Hash::make('Coordinator1!'),
        'is_active'            => true,
        'password_changed_at'  => now(),
        'must_change_password' => false,
        'email_verified_at'    => now(),
      ]);

      $user->assignRole('marketing_coordinator');

      $staffId = $this->generateId('STF', fn($id) => Staff::where('staff_id', $id)->exists());

      Staff::create([
        'user_id'    => $user->id,
        'staff_id'   => $staffId,
        'faculty_id' => $faculty->id,
        'department' => $faculty->name,
        'position'   => 'Marketing Coordinator',
        'hire_date'  => now()->subYears(2),
      ]);

      $this->command->info("Coordinator created: {$name} ({$email})");
    }
  }

  private function seedPostsAndContributions(array $academicYears): void
  {
    $faculties = Faculty::all();
    $admin     = User::role('admin')->first();

    $topics = [
      'SE'  => ['The Future of Agile Development', 'Microservices in Practice', 'DevOps Culture Shift', 'Test-Driven Design Patterns', 'Low-Code Platforms'],
      'CN'  => ['5G Network Architecture', 'Software Defined Networking', 'Network Automation with Python', 'Wi-Fi 7 Explained', 'Edge Computing Trends'],
      'CS'  => ['Algorithms in Everyday Life', 'Quantum Computing Basics', 'Functional Programming Revival', 'Open Source Contribution Guide', 'Compilers Demystified'],
      'CYB' => ['Zero Trust Security Model', 'Phishing Attack Prevention', 'Ransomware Case Studies', 'Ethical Hacking Career Path', 'Security Operations Centre'],
      'DSA' => ['Machine Learning in Healthcare', 'Data Ethics and Privacy', 'Neural Networks Explained', 'Big Data Pipeline Design', 'AI Bias and Fairness'],
      'BIT' => ['Digital Transformation Strategy', 'ERP System Implementation', 'IT Governance Frameworks', 'Business Process Automation', 'Cloud ROI Analysis'],
      'FT'  => ['Blockchain in Banking', 'DeFi and the Future of Finance', 'Cryptocurrency Regulation', 'AI-Driven Trading Systems', 'Open Banking APIs'],
      'IS'  => ['Database Design Best Practices', 'Information Security Audits', 'Digital Archiving Systems', 'KPI Dashboards for Managers', 'Legacy System Migration'],
      'CC'  => ['Kubernetes at Scale', 'Multi-Cloud Strategy', 'Serverless Architecture', 'Cloud Cost Optimisation', 'Container Security Basics'],
    ];

    $statuses    = ['approved', 'approved', 'approved', 'rejected', 'submitted', 'under_review'];
    $studyLevels = ['undergraduate', 'undergraduate', 'postgraduate', 'doctorate'];

    foreach ($faculties as $faculty) {
      $facultyTopics = $topics[$faculty->code] ?? ['Innovation in Technology', 'Research Trends', 'Industry Insights', 'Digital Futures', 'Academic Excellence'];

      foreach ($academicYears as $year => $academicYear) {

        $post = Post::firstOrCreate(
          [
            'faculty_id'       => $faculty->id,
            'academic_year_id' => $academicYear->id,
          ],
          [
            'title'        => "{$faculty->name} – {$academicYear->name} Submissions",
            'description'  => $this->loremShort,
            'created_by'   => $admin?->id,
            'closure_date' => $academicYear->closure_date,
            'is_published' => true,
          ]
        );

        $count = rand(5, 8);
        for ($i = 1; $i <= $count; $i++) {
          $name      = $this->fakeName();
          $email     = $this->nameToEmail($name);
          $studentId = $this->generateId('KSF', fn($id) => Student::where('student_id', $id)->exists());

          $studentUser = User::create([
            'name'                 => $name,
            'email'                => $email,
            'password'             => Hash::make('Student1!'),
            'is_active'            => true,
            'password_changed_at'  => now()->subYear(),
            'must_change_password' => false,
            'email_verified_at'    => now()->subYear(),
            'last_login_at'        => now()->subDays(rand(1, 90)),
          ]);

          $studentUser->assignRole('student');

          $program = $faculty->activePrograms()->inRandomOrder()->first();

          $student = Student::create([
            'user_id'         => $studentUser->id,
            'student_id'      => $studentId,
            'faculty_id'      => $faculty->id,
            'program'         => $program?->name ?? 'B.Sc ' . $faculty->name,
            'enrollment_year' => $year - rand(0, 2),
            'study_level'     => $studyLevels[array_rand($studyLevels)],
          ]);

          $status = $statuses[array_rand($statuses)];
          $topic  = $facultyTopics[($i - 1) % count($facultyTopics)];

          $contribution = Contribution::create([
            'student_id'        => $student->id,
            'post_id'           => $post->id,
            'academic_year_id'  => $academicYear->id,
            'title'             => $topic,
            'description'       => $this->loremLong,
            'terms_accepted'    => true,
            'terms_accepted_at' => now()->subYear(),
            'status'            => $status,
            'is_selected'       => $status === 'approved',
            'selected_at'       => $status === 'approved' ? now()->subMonths(rand(1, 6)) : null,
            'created_at'        => now()->subYear()->addDays(rand(1, 60)),
          ]);

          if (rand(1, 10) <= 7) {
            $coordinator = Staff::where('faculty_id', $faculty->id)
              ->whereHas('user', fn($q) => $q->role('marketing_coordinator'))
              ->first()?->user;

            if ($coordinator) {
              Comment::create([
                'contribution_id' => $contribution->id,
                'user_id'         => $coordinator->id,
                'content'         => 'Thank you for your submission. ' . $this->loremShort,
                'created_at'      => $contribution->created_at->addDays(rand(1, 10)),
              ]);
            }
          }
        }
      }
    }
  }
}
