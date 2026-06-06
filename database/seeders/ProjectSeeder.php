<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::create([
            'title' => 'Luki Online',
            'slug' => 'luki-online',
            'category' => 'Service Marketplace',
            'description' => 'A digital service marketplace connecting providers with customers across Uganda.',
            'tags' => ['Marketplace', 'Mobile App', 'Services'],
            'project_url' => null,
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Project::create([
            'title' => 'Novas 360 - POS, Inventory & HRM',
            'slug' => 'novas-360',
            'category' => 'Retail Technology',
            'description' => 'Cloud-based Point of Sale system that empowers retail businesses to manage sales, inventory, and reporting in real time.',
            'tags' => ['React', 'Node.js', 'PostgreSQL', 'Cloud'],
            'project_url' => 'https://getnovas.com/',
            'is_featured' => true,
            'sort_order' => 2,
        ]);

        Project::create([
            'title' => 'Healingway Fertility Centre',
            'slug' => 'healingway-fertility-centre',
            'category' => 'Healthcare',
            'description' => 'Complete website and online booking system that streamlines patient appointments and information for a fertility clinic.',
            'tags' => ['React', 'Booking System', 'Healthcare'],
            'project_url' => 'https://healingwayfertility.com/',
            'is_featured' => false,
            'sort_order' => 3,
        ]);

        Project::create([
            'title' => 'Bondemala Investments Website',
            'slug' => 'bondemala-investments',
            'category' => 'Corporate',
            'description' => 'A multi-sector company website that introduces Bondemala Investments across agriculture, finance, and business services.',
            'tags' => ['Next.js', 'Corporate', 'Website'],
            'project_url' => 'https://bondemalainvestmentsmc.com/',
            'is_featured' => false,
            'sort_order' => 4,
        ]);

        Project::create([
            'title' => 'Property Auctioneers UG',
            'slug' => 'property-auctioneers-ug',
            'category' => 'Real Estate',
            'description' => 'A property listing platform showcasing available properties with detailed search and contact capabilities.',
            'tags' => ['Real Estate', 'Property Listings', 'Website'],
            'project_url' => 'https://propertyauctioneersug.com/',
            'is_featured' => true,
            'sort_order' => 5,
        ]);

        Project::create([
            'title' => 'TheTechTower',
            'slug' => 'thetechtower',
            'category' => 'Content & Media',
            'description' => 'A tech blog for enthusiasts covering the latest in technology, development, and digital innovation.',
            'tags' => ['Blog', 'Content', 'Tech'],
            'project_url' => 'https://thetechtower.com/',
            'is_featured' => true,
            'sort_order' => 6,
        ]);

        Project::create([
            'title' => 'Nfunayo',
            'slug' => 'nfunayo',
            'category' => 'Fintech',
            'description' => 'A modern lending platform designed for money lenders to manage loans, payments, and client relationships efficiently.',
            'tags' => ['Fintech', 'Lending', 'Mobile App'],
            'project_url' => 'https://nfunayo.com/',
            'is_featured' => false,
            'sort_order' => 7,
        ]);
    }
}
