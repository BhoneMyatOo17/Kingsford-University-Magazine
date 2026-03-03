<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Program;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name'        => 'Software Engineering',
                'code'        => 'SE',
                'description' => 'Focuses on the engineering of robust software systems for modern industry.',
                'programs'    => [
                    [
                        'name'               => 'B.Sc Software Engineering',
                        'description'        => 'Focuses on building core computing and programming skills and the engineering of robust software systems for modern industry.',
                        'level'              => 'undergraduate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 5000.00,
                    ],
                    [
                        'name'               => 'M.Sc Software Engineering',
                        'description'        => 'Focuses on advanced software architecture, agile methodologies, and large-scale system design.',
                        'level'              => 'postgraduate',
                        'duration_years'     => 2,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 5500.00,
                    ],
                    [
                        'name'               => 'PhD Software Engineering',
                        'description'        => 'Focuses on original research in software engineering methodologies, tools, and emerging technologies.',
                        'level'              => 'doctorate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time / Part-time',
                        'fees_per_semester'  => 6000.00,
                    ],
                ],
            ],
            [
                'name'        => 'Computer Networks',
                'code'        => 'CN',
                'description' => 'Focuses on networking infrastructure, security, and communication systems.',
                'programs'    => [
                    [
                        'name'               => 'B.Sc Computer Networks',
                        'description'        => 'Focuses on networking fundamentals, protocols, and infrastructure management.',
                        'level'              => 'undergraduate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 5000.00,
                    ],
                    [
                        'name'               => 'M.Sc Network Security',
                        'description'        => 'Focuses on advanced network security, cryptography, and cyber defence strategies.',
                        'level'              => 'postgraduate',
                        'duration_years'     => 2,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 6000.00,
                    ],
                    [
                        'name'               => 'PhD Advanced Networking',
                        'description'        => 'Focuses on original research in next-generation networking, IoT, and distributed systems.',
                        'level'              => 'doctorate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time / Part-time',
                        'fees_per_semester'  => 6700.00,
                    ],
                ],
            ],
            [
                'name'        => 'Computer Science',
                'code'        => 'CS',
                'description' => 'Covers the theoretical foundations and practical applications of computing.',
                'programs'    => [
                    [
                        'name'               => 'B.Sc Computer Science',
                        'description'        => 'Covers algorithms, data structures, programming languages, and core computing theory for a broad foundation in computer science.',
                        'level'              => 'undergraduate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 5800.00,
                    ],
                    [
                        'name'               => 'M.Sc Computer Science',
                        'description'        => 'Focuses on advanced computing topics including distributed systems, machine learning, and software theory.',
                        'level'              => 'postgraduate',
                        'duration_years'     => 2,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 6230.00,
                    ],
                    [
                        'name'               => 'PhD Computer Science',
                        'description'        => 'Focuses on original research contributions to the field of computer science across a wide range of specialisations.',
                        'level'              => 'doctorate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time / Part-time',
                        'fees_per_semester'  => 6850.00,
                    ],
                ],
            ],
            [
                'name'        => 'Cybersecurity',
                'code'        => 'CYB',
                'description' => 'Focuses on protecting digital systems, networks, and data from cyber threats.',
                'programs'    => [
                    [
                        'name'               => 'B.Sc Cybersecurity',
                        'description'        => 'Focuses on ethical hacking, network defence, and the principles of securing information systems against cyber threats.',
                        'level'              => 'undergraduate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 5800.00,
                    ],
                    [
                        'name'               => 'M.Sc Cybersecurity',
                        'description'        => 'Focuses on advanced threat analysis, digital forensics, incident response, and enterprise security architecture.',
                        'level'              => 'postgraduate',
                        'duration_years'     => 2,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 6200.00,
                    ],
                    [
                        'name'               => 'PhD Cybersecurity',
                        'description'        => 'Focuses on original research in cyber threat intelligence, cryptographic systems, and next-generation security solutions.',
                        'level'              => 'doctorate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time / Part-time',
                        'fees_per_semester'  => 6900.00,
                    ],
                ],
            ],
            [
                'name'        => 'Data Science & Artificial Intelligence',
                'code'        => 'DSA',
                'description' => 'Combines statistical analysis, machine learning, and AI to extract insights from data.',
                'programs'    => [
                    [
                        'name'               => 'B.Sc Data Science',
                        'description'        => 'Focuses on statistical modelling, data visualisation, and machine learning to support data-driven decision-making.',
                        'level'              => 'undergraduate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 6000.00,
                    ],
                    [
                        'name'               => 'M.Sc Artificial Intelligence',
                        'description'        => 'Focuses on deep learning, natural language processing, computer vision, and the deployment of intelligent systems.',
                        'level'              => 'postgraduate',
                        'duration_years'     => 2,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 7200.00,
                    ],
                    [
                        'name'               => 'M.Sc Data Analytics',
                        'description'        => 'Focuses on big data technologies, predictive analytics, and data engineering for enterprise and research environments.',
                        'level'              => 'postgraduate',
                        'duration_years'     => 2,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 7000.00,
                    ],
                    [
                        'name'               => 'PhD Artificial Intelligence',
                        'description'        => 'Focuses on cutting-edge research in AI, including autonomous systems, explainability, and AI ethics.',
                        'level'              => 'doctorate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time / Part-time',
                        'fees_per_semester'  => 7900.00,
                    ],
                ],
            ],
            [
                'name'        => 'Business Information Technology',
                'code'        => 'BIT',
                'description' => 'Combines business strategy with information technology management.',
                'programs'    => [
                    [
                        'name'               => 'B.Sc Business Information Technology',
                        'description'        => 'Focuses on IT management, business analysis, and digital transformation within organisations.',
                        'level'              => 'undergraduate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 6200.00,
                    ],
                    [
                        'name'               => 'M.Sc IT Management',
                        'description'        => 'Focuses on strategic IT leadership, enterprise architecture, and digital business innovation.',
                        'level'              => 'postgraduate',
                        'duration_years'     => 2,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 6500.00,
                    ],
                    [
                        'name'               => 'PhD Business Information Technology',
                        'description'        => 'Focuses on original research in digital business strategy, IT governance, and technology-driven organisational transformation.',
                        'level'              => 'doctorate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time / Part-time',
                        'fees_per_semester'  => 6850.00,
                    ],
                ],
            ],
            [
                'name'        => 'Financial Technology (FinTech)',
                'code'        => 'FT',
                'description' => 'Combines finance, programming, and data analysis for modern banking and payment systems.',
                'programs'    => [
                    [
                        'name'               => 'B.Sc. FinTech',
                        'description'        => 'Focuses on the fundamentals of finance, programming, and data analysis as they apply to modern banking and mobile payment systems.',
                        'level'              => 'undergraduate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 6300.00,
                    ],
                    [
                        'name'               => 'M.Sc. Financial Innovation',
                        'description'        => 'Focuses on blockchain technologies, digital currencies, financial automation, and AI-driven services through real-world digital finance case studies.',
                        'level'              => 'postgraduate',
                        'duration_years'     => 2,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 7000.00,
                    ],
                    [
                        'name'               => 'M.Sc. Financial Analytics',
                        'description'        => 'Focuses on using advanced data analytics, predictive modelling, and algorithmic systems to drive strategic decision-making in financial institutions.',
                        'level'              => 'postgraduate',
                        'duration_years'     => 2,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 7200.00,
                    ],
                    [
                        'name'               => 'PhD FinTech & Emerging Finance',
                        'description'        => 'Focuses on original research in decentralized finance (DeFi), financial cybersecurity, and the impact of AI on global financial systems.',
                        'level'              => 'doctorate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time / Part-time',
                        'fees_per_semester'  => 7700.00,
                    ],
                ],
            ],
            [
                'name'        => 'Information System',
                'code'        => 'IS',
                'description' => 'Focuses on designing, managing, and analysing information systems that support business operations.',
                'programs'    => [
                    [
                        'name'               => 'B.Sc Information System',
                        'description'        => 'Focuses on designing, managing, and analysing information systems that support business operations and data-driven decision-making.',
                        'level'              => 'undergraduate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 5600.00,
                    ],
                    [
                        'name'               => 'M.Sc Information System',
                        'description'        => 'Focuses on advanced information systems architecture, data management, and enterprise solutions to enhance organisational efficiency.',
                        'level'              => 'postgraduate',
                        'duration_years'     => 2,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 6200.00,
                    ],
                    [
                        'name'               => 'PhD Information System',
                        'description'        => 'Focuses on research in information systems theory, digital innovation, and the strategic impact of technology on organisations and society.',
                        'level'              => 'doctorate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time / Part-time',
                        'fees_per_semester'  => 6800.00,
                    ],
                ],
            ],
            [
                'name'        => 'Cloud Computing',
                'code'        => 'CC',
                'description' => 'Focuses on virtualization, cloud infrastructure management, and distributed platforms.',
                'programs'    => [
                    [
                        'name'               => 'B.Sc. Cloud Computing',
                        'description'        => 'Focuses on introducing virtualization, cloud infrastructure management, and programming for modern distributed platforms.',
                        'level'              => 'undergraduate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 5800.00,
                    ],
                    [
                        'name'               => 'M.Sc. Cloud Security',
                        'description'        => 'Focuses on safeguarding cloud environments through identity management, threat response, and enterprise security compliance.',
                        'level'              => 'postgraduate',
                        'duration_years'     => 2,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 6800.00,
                    ],
                    [
                        'name'               => 'M.Sc. Enterprise Cloud Systems',
                        'description'        => 'Focuses on managing large-scale environments, multi-cloud architecture, and complex service orchestration for enterprise solutions.',
                        'level'              => 'postgraduate',
                        'duration_years'     => 2,
                        'duration_mode'      => 'Full-time',
                        'fees_per_semester'  => 7500.00,
                    ],
                    [
                        'name'               => 'PhD Advanced Cloud Computing',
                        'description'        => 'Focuses on advanced cloud automation, architectural optimization, and designing complex, scalable cloud solutions for the tech industry.',
                        'level'              => 'doctorate',
                        'duration_years'     => 4,
                        'duration_mode'      => 'Full-time / Part-time',
                        'fees_per_semester'  => 7300.00,
                    ],
                ],
            ],
        ];

        foreach ($data as $facultyData) {
            $programs = $facultyData['programs'];
            unset($facultyData['programs']);

            $faculty = Faculty::firstOrCreate(
                ['code' => $facultyData['code']],
                array_merge($facultyData, ['is_active' => true])
            );

            foreach ($programs as $programData) {
                Program::firstOrCreate(
                    ['faculty_id' => $faculty->id, 'name' => $programData['name']],
                    array_merge($programData, ['is_active' => true])
                );
            }
        }
    }
}
