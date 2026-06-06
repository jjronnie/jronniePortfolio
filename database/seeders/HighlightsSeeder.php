<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class HighlightsSeeder extends Seeder
{
    public function run(): void
    {
        Experience::create([
            'type' => 'highlights',
            'title' => 'Deployed my first professional application & started my Bachelors degree',
            'subtitle' => '2022',
            'start_date' => '2022',
            'end_date' => null,
            'points' => [
                'Somehow convinced a paying client that I knew what I was doing — imposter syndrome has been my co-pilot ever since.',
                'Managed to ship code that didn\'t immediately crash in production. Mostly.',
                'Enrolled for a Bachelors degree thinking I\'d learn everything. Instead, I learned that Stack Overflow is the real university.',
            ],
            'tags' => null,
            'sort_order' => 1,
        ]);

        Experience::create([
            'type' => 'highlights',
            'title' => 'Launched my startup',
            'subtitle' => '2024',
            'start_date' => '2024',
            'end_date' => null,
            'points' => [
                'Officially became a "CEO" — which in reality means I\'m also the janitor, the accountant, the sales team, and the guy who fixes the printer.',
                'Learned that 90% of running a business is replying to emails and the other 10% is panicking about cash flow.',
                'Built products that people actually paid for. Still not sure if they were being generous or desperate.',
            ],
            'tags' => null,
            'sort_order' => 2,
        ]);

        Experience::create([
            'type' => 'highlights',
            'title' => 'Tried dual citizenship, employed and self-employed at the same time',
            'subtitle' => '2025',
            'start_date' => '2025',
            'end_date' => null,
            'points' => [
                'Discovered that "agile" really means "we change our minds every standup and still pretend we\'re on track."',
                'Got paid to write code AND someone else handled the printer. Revolutionary concept.',
                'Realised that meetings about meetings are somehow a legitimate line item on timesheets.',
            ],
            'tags' => null,
            'sort_order' => 3,
        ]);

        Experience::create([
            'type' => 'highlights',
            'title' => 'Discovered employment wasn\'t for me — self-employment was the way to go',
            'subtitle' => '2026',
            'start_date' => '2026',
            'end_date' => null,
            'points' => [
                'Traded a steady paycheck for the thrill of waking up and wondering where the next client will come from. Thrilling stuff.',
                'Nobody tells you that being your own boss means you also have the world\'s strictest boss — yourself. And he\'s a jerk.',
                'At least now I can wear pyjamas to "the office" and nobody judges me. Much.',
            ],
            'tags' => null,
            'sort_order' => 4,
        ]);

        Experience::create([
            'type' => 'highlights',
            'title' => 'Graduated with a Bachelors degree',
            'subtitle' => '2026',
            'start_date' => '2026',
            'end_date' => null,
            'points' => [
                'Three years of lectures, caffeine, and pretending to understand Java — finally paid off with a piece of paper.',
                'The degree is nice, but let\'s be honest: Google, YouTube, and ChatGPT taught me more than any syllabus ever did.',
                'Walked across that stage thinking, "I have absolutely no idea what I\'m doing." Which is exactly how I felt on day one. Some things never change.',
            ],
            'tags' => null,
            'sort_order' => 5,
        ]);
    }
}
