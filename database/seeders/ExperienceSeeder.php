<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        // Work
        Experience::create([
            'type' => 'work',
            'title' => 'Software Development Lead',
            'subtitle' => 'TechTower Innovations Africa Co. Ltd',
            'start_date' => '2022',
            'end_date' => 'Present',
            'points' => [
                'Lead delivery of web platforms and internal tooling with a focus on secure, scalable code',
                'Standardized build & deployment workflows -- fewer environment bugs, faster releases',
                'Mentor junior engineers through code reviews and pairing, improving overall quality',
                'Hardened authentication, authorization and data handling across products',
            ],
            'tags' => ['Team Lead', 'Architecture', 'Mentorship', 'Security'],
            'sort_order' => 1,
        ]);

        Experience::create([
            'type' => 'work',
            'title' => 'Head of IT Department',
            'subtitle' => 'Arrow Security Systems Limited',
            'start_date' => '2025',
            'end_date' => '2026',
            'points' => [
                'Architected and shipped a centralized Human Resource Management System that streamlined HR operations and reporting',
                'Owned end-to-end IT support across hardware, networking and software -- keeping the company online and productive',
                'Administered electronic alarm and security infrastructure to safeguard operations',
                'Ran user enablement sessions that lifted adoption of internal tools across departments',
            ],
            'tags' => ['Leadership', 'HRMS', 'Infrastructure', 'Training'],
            'sort_order' => 2,
        ]);

        Experience::create([
            'type' => 'work',
            'title' => 'Chief Technology Officer',
            'subtitle' => 'Bondemala Investments SMC Limited',
            'start_date' => '2024',
            'end_date' => 'Present',
            'points' => [
                'Set the company\'s technology direction and architecture across digital platforms',
                'Launched Bondemala\'s flagship digital products with seamless front-to-back integration',
                'Lifted SEO visibility and site performance through targeted technical optimization',
                'Established reliable hosting and deployment practices for stable uptime',
            ],
            'tags' => ['Strategy', 'Architecture', 'SEO', 'Hosting'],
            'sort_order' => 3,
        ]);

        Experience::create([
            'type' => 'work',
            'title' => 'Business Intelligence Intern',
            'subtitle' => 'Casements (A) Limited',
            'start_date' => '2024',
            'end_date' => '2024',
            'points' => [
                'Redesigned the corporate website for a modern, mobile-first experience',
                'Built a customer feedback pipeline that surfaced actionable insights for management',
                'Created Power BI dashboards and Excel models that simplified monthly reporting',
            ],
            'tags' => ['WordPress', 'Power BI', 'Analytics'],
            'sort_order' => 4,
        ]);

        // Education
        Experience::create([
            'type' => 'education',
            'title' => "Bachelor's Degree in Business Computing",
            'subtitle' => 'Makerere University',
            'start_date' => '2022',
            'end_date' => '2026',
            'description' => 'Business systems, software engineering and information management',
            'sort_order' => 5,
        ]);

        Experience::create([
            'type' => 'education',
            'title' => 'Full Stack Development',
            'subtitle' => 'Free Code Camp / Udemy',
            'start_date' => 'May 2023',
            'end_date' => 'Sep 2023',
            'description' => 'React, Node.js, MongoDB and Express mastery across modern web stacks',
            'sort_order' => 6,
        ]);

        Experience::create([
            'type' => 'education',
            'title' => 'Google Android Developer Certificate',
            'subtitle' => 'Google Inc.',
            'start_date' => 'Apr 2022',
            'end_date' => 'Aug 2022',
            'description' => 'Official Google certification -- Kotlin and Android SDK proficiency',
            'sort_order' => 7,
        ]);
    }
}
