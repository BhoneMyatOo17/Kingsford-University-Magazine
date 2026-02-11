<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faculty;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faculties = [
            [
                'name' => 'Software Engineering',
                'code' => 'SE',
                'description' => 'Master the art of building scalable, secure, and innovative software solutions for the digital age.',
                'is_active' => true,
            ],
            [
                'name' => 'Computer Network',
                'code' => 'CN',
                'description' => 'Design and manage robust network infrastructures that power global connectivity and communications.',
                'is_active' => true,
            ],
            [
                'name' => 'Computer Science',
                'code' => 'CS',
                'description' => 'Explore the fundamentals of computing, algorithms, and theoretical foundations of technology.',
                'is_active' => true,
            ],
            [
                'name' => 'Cybersecurity',
                'code' => 'CYB',
                'description' => 'Protect digital assets and combat cyber threats with advanced security methodologies and practices.',
                'is_active' => true,
            ],
            [
                'name' => 'Data Science & AI',
                'code' => 'DSAI',
                'description' => 'Harness the power of data and artificial intelligence to drive insights and innovation.',
                'is_active' => true,
            ],
            [
                'name' => 'Business IT',
                'code' => 'BIT',
                'description' => 'Combine business acumen with technical expertise to lead digital transformation initiatives.',
                'is_active' => true,
            ],
            [
                'name' => 'FinTech',
                'code' => 'FT',
                'description' => 'Bridge technology and finance to revolutionize banking, payments, and financial services.',
                'is_active' => true,
            ],
            [
                'name' => 'Information Systems',
                'code' => 'IS',
                'description' => 'Integrate technology and business processes to optimize organizational efficiency and innovation.',
                'is_active' => true,
            ],
            [
                'name' => 'Cloud Computing',
                'code' => 'CC',
                'description' => 'Master cloud technologies and architecture to build scalable, resilient distributed systems.',
                'is_active' => true,
            ],
        ];

        foreach ($faculties as $faculty) {
            Faculty::create($faculty);
        }
    }
}