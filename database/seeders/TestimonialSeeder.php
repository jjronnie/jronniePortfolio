<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::create([
            'name' => 'Wamala Peko Roy',
            'role' => 'CEO, Bondemala',
            'quote' => 'Jjuuko built our company website and custom management systems that streamlined our entire operations. Professional, fast, and delivered ahead of schedule. Highly recommend his services.',
            'rating' => 5,
            'avatar_initial' => 'W',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        Testimonial::create([
            'name' => 'Loyce Uwimaana',
            'role' => 'Pamoja Chambers',
            'quote' => 'Jjuuko developed our company website and handled the SEO optimization. Our online visibility has improved dramatically, and we\'re now getting leads consistently from search traffic.',
            'rating' => 5,
            'avatar_initial' => 'L',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        Testimonial::create([
            'name' => 'Dr. Dale Mugisha',
            'role' => 'Healingway Fertility',
            'quote' => 'The website with integrated booking system Jjuuko built for our hospital has made appointments seamless for our patients. The system handles scheduling, reminders, and payments effortlessly.',
            'rating' => 5,
            'avatar_initial' => 'D',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        Testimonial::create([
            'name' => 'Kiyemba Isaac',
            'role' => 'IK Investments',
            'quote' => 'Nova 360 has transformed how I manage my business. As a user of this platform that Jjuuko built, I can track inventory, sales, and customer data all in one place. It\'s intuitive and powerful.',
            'rating' => 5,
            'avatar_initial' => 'K',
            'sort_order' => 4,
            'is_active' => true,
        ]);
    }
}
