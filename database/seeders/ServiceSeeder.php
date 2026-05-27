<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'title' => 'Web Development',
            'slug' => 'web-development',
            'icon' => 'globe',
            'description' => 'Custom web applications crafted with React, Next.js, Laravel and modern frameworks.',
            'icon_svg' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Z"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>',
            'features' => ['Responsive Design', 'Performance Optimization', 'SEO Friendly', 'Cross-browser'],
            'type' => 'core',
            'sort_order' => 1,
        ]);

        Service::create([
            'title' => 'Mobile App Development',
            'slug' => 'mobile-app-development',
            'icon' => 'smartphone',
            'description' => 'Cross-platform iOS and Android apps built with Flutter for native-grade feel.',
            'icon_svg' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/></svg>',
            'features' => ['Native Performance', 'Beautiful UI/UX', 'Offline Support', 'Push Notifications'],
            'type' => 'core',
            'sort_order' => 2,
        ]);

        Service::create([
            'title' => 'SEO Optimization',
            'slug' => 'seo-optimization',
            'icon' => 'search',
            'description' => 'Lift your visibility on search with technical and on-page SEO done right.',
            'icon_svg' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>',
            'features' => ['Keyword Research', 'On-page SEO', 'Technical SEO', 'Performance Audits'],
            'type' => 'core',
            'sort_order' => 3,
        ]);

        Service::create([
            'title' => 'UI / UX Design',
            'slug' => 'ui-ux-design',
            'icon' => 'palette',
            'description' => 'Intuitive, visually striking interfaces backed by user research and systems thinking.',
            'icon_svg' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="13.5" cy="6.5" r=".5" fill="currentColor"/><circle cx="17.5" cy="10.5" r=".5" fill="currentColor"/><circle cx="8.5" cy="7.5" r=".5" fill="currentColor"/><circle cx="6.5" cy="12.5" r=".5" fill="currentColor"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.93 0 1.5-.6 1.5-1.5 0-.4-.15-.73-.4-1-.26-.27-.6-.5-.6-1 0-.83.67-1.5 1.5-1.5H14c4.42 0 8-3.58 8-8 0-4.42-4.42-8-10-8z"/></svg>',
            'features' => ['User Research', 'Wireframing', 'Prototyping', 'Design Systems'],
            'type' => 'core',
            'sort_order' => 4,
        ]);

        Service::create([
            'title' => 'Backend Development',
            'slug' => 'backend-development',
            'icon' => 'server',
            'description' => 'Robust server-side solutions, secure APIs and well-modeled databases.',
            'icon_svg' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"/><rect x="2" y="14" width="20" height="8" rx="2" ry="2"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/></svg>',
            'features' => ['RESTful APIs', 'Database Design', 'Authentication', 'Cloud Integration'],
            'type' => 'core',
            'sort_order' => 5,
        ]);

        Service::create([
            'title' => 'WordPress Development',
            'slug' => 'wordpress-development',
            'icon' => 'layout',
            'description' => 'Custom WordPress themes, plugins and e-commerce builds that scale.',
            'icon_svg' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.57 3.9a2 2 0 0 0 1.66 0l8.57-3.9a1 1 0 0 0 0-1.83Z"/><path d="m22 11.08-8.57 3.9a2 2 0 0 1-1.66 0L3 11.08"/><path d="m22 16.08-8.57 3.9a2 2 0 0 1-1.66 0L3 16.08"/></svg>',
            'features' => ['Custom Themes', 'Plugin Development', 'E-commerce', 'Maintenance'],
            'type' => 'core',
            'sort_order' => 6,
        ]);

        Service::create([
            'title' => 'Performance Optimization',
            'slug' => 'performance-optimization',
            'icon' => 'zap',
            'description' => 'Speed up your site and dramatically improve user experience and Core Web Vitals.',
            'icon_svg' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/></svg>',
            'features' => null,
            'type' => 'beyond',
            'sort_order' => 7,
        ]);

        Service::create([
            'title' => 'Security Audits',
            'slug' => 'security-audits',
            'icon' => 'shield',
            'description' => 'Comprehensive security analysis and hardening across your app and infrastructure.',
            'icon_svg' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
            'features' => null,
            'type' => 'beyond',
            'sort_order' => 8,
        ]);
    }
}
