<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Categories
        $webDev = PostCategory::create([
            'name' => 'Web Development',
            'slug' => 'web-development',
            'description' => 'Articles about web development, Laravel, PHP, React, and frontend technologies for building modern websites and web applications.',
            'meta_title' => 'Web Development Articles — Jjuuko Ronald, Uganda Developer',
            'meta_description' => 'Explore web development tutorials and insights by Jjuuko Ronald. Learn about Laravel, PHP, React, Vue.js, and building modern web apps in Uganda and East Africa.',
            'sort_order' => 1,
        ]);

        $mobileCat = PostCategory::create([
            'name' => 'Mobile Development',
            'slug' => 'mobile-development',
            'description' => 'Tips, tutorials, and insights on Flutter, Dart, and cross-platform mobile app development for Android and iOS.',
            'meta_title' => 'Mobile App Development Articles — Jjuuko Ronald, Kampala Uganda',
            'meta_description' => 'Mobile app development articles covering Flutter, Dart, cross-platform apps for Android and iOS, and the East African mobile tech ecosystem by Jjuuko Ronald.',
            'sort_order' => 2,
        ]);

        // Tags
        $laravel = Tag::create(['name' => 'Laravel', 'slug' => 'laravel']);
        $react = Tag::create(['name' => 'React', 'slug' => 'react']);
        $flutter = Tag::create(['name' => 'Flutter', 'slug' => 'flutter']);
        $uganda = Tag::create(['name' => 'Uganda', 'slug' => 'uganda']);
        $eastAfrica = Tag::create(['name' => 'East Africa', 'slug' => 'east-africa']);
        $seo = Tag::create(['name' => 'SEO', 'slug' => 'seo']);
        $php = Tag::create(['name' => 'PHP', 'slug' => 'php']);
        $mobileTag = Tag::create(['name' => 'Mobile Apps', 'slug' => 'mobile-apps']);
        $web = Tag::create(['name' => 'Web Apps', 'slug' => 'web-apps']);
        $business = Tag::create(['name' => 'Business', 'slug' => 'business']);

        // Post 1: Why Laravel is the Best Framework for Web Development in Uganda
        $post1 = Post::create([
            'post_category_id' => $webDev->id,
            'title' => 'Why Laravel is the Best PHP Framework for Web Development in Uganda',
            'slug' => 'why-laravel-best-php-framework-web-development-uganda',
            'excerpt' => 'Discover why Laravel has become the go-to PHP framework for web development in Uganda and East Africa — from rapid development and MVC architecture to built-in security, Eloquent ORM, and a thriving ecosystem perfect for local businesses.',
            'body' => '<h2>Why Laravel Dominates Web Development in Uganda</h2><p>Laravel has become the most popular PHP framework worldwide, and for good reason. In Uganda, the adoption of Laravel has grown significantly among developers and businesses looking for robust, scalable, and secure web applications. Here is why Laravel is the best choice for web development in Uganda.</p><h3>Rapid Development with MVC Architecture</h3><p>Laravel\'s MVC (Model-View-Controller) architecture allows developers in Kampala and across Uganda to build applications faster. With built-in features like Artisan CLI, migration system, and Blade templating, a Laravel developer can deliver a production-ready web application in a fraction of the time it would take with vanilla PHP or other frameworks.</p><h3>Built-in Security Features</h3><p>For Ugandan businesses handling customer data, payment information, and sensitive records, security is paramount. Laravel provides CSRF protection, SQL injection prevention through Eloquent ORM, hashed password storage, and XSS prevention out of the box. This means businesses in Kampala can trust their web applications to be secure by default.</p><h3>Eloquent ORM for African Business Logic</h3><p>Eloquent ORM makes database interactions intuitive and expressive. For complex East African business requirements — multi-currency support, inventory management, customer relationship tracking — Eloquent provides a clean, readable syntax that maps perfectly to real-world business logic.</p><h3>Scalability for Growing Businesses</h3><p>Whether you are a startup in Kampala or an established enterprise serving clients across East Africa, Laravel scales with you. From Redis caching to queue management with Horizon, Laravel handles growth without requiring a complete rewrite of your application.</p><h3>Thriving Ecosystem</h3><p>The Laravel ecosystem includes tools like Forge for server management, Vapor for serverless deployment, Cashier for subscription billing, and Socialite for OAuth authentication. These tools reduce development time and help Ugandan developers compete globally.</p><h3>Local Developer Community</h3><p>There is a growing community of Laravel developers in Uganda, with meetups, online forums, and knowledge sharing. Hiring a Laravel developer in Kampala is easier than ever, and the community continues to grow as more businesses recognize the framework\'s value.</p><h2>Conclusion</h2><p>For businesses in Uganda and East Africa looking for a reliable, secure, and scalable web development framework, Laravel is the clear winner. Its combination of rapid development, security, scalability, and a thriving ecosystem makes it the ideal choice for web applications in the Ugandan market.</p>',
            'meta_title' => 'Why Laravel is the Best PHP Framework for Web Development in Uganda',
            'meta_description' => 'Discover why Laravel is the top choice for web development in Uganda and East Africa. Learn about its security, scalability, Eloquent ORM, and growing developer community in Kampala.',
            'meta_keywords' => 'Laravel Uganda, PHP framework Uganda, web development Kampala, Laravel developer Uganda, PHP development East Africa, best framework Uganda, web applications Uganda',
            'schema_type' => 'TechArticle',
            'robots' => 'index,follow',
            'reading_time_minutes' => 5,
            'status' => 'published',
            'published_at' => $now->copy()->subDays(2),
            'is_featured' => true,
            'include_in_sitemap' => true,
            'include_in_feed' => true,
            'author_name' => 'Jjuuko Ronald',
            'sitemap_priority' => 0.9,
            'sitemap_changefreq' => 'monthly',
        ]);

        $post1->tags()->sync([$laravel->id, $php->id, $web->id, $uganda->id, $eastAfrica->id]);

        // Post 2: Building Cross-Platform Mobile Apps with Flutter in East Africa
        $post2 = Post::create([
            'post_category_id' => $mobileCat->id,
            'title' => 'Building Cross-Platform Mobile Apps with Flutter for East African Businesses',
            'slug' => 'building-cross-platform-mobile-apps-flutter-east-african-businesses',
            'excerpt' => 'Explore how Flutter is revolutionizing mobile app development for businesses in Uganda, Kenya, Tanzania, and across East Africa — reducing costs, accelerating time-to-market, and delivering native-quality apps for both Android and iOS.',
            'body' => '<h2>Flutter: The Future of Mobile App Development in East Africa</h2><p>Flutter, Google\'s UI toolkit for building natively compiled applications from a single codebase, has transformed mobile app development worldwide. For businesses in Uganda, Kenya, Tanzania, Rwanda, and across East Africa, Flutter offers a unique opportunity to build high-quality mobile applications at a fraction of the traditional cost.</p><h3>One Codebase for Android and iOS</h3><p>The biggest advantage of Flutter for East African businesses is the ability to target both Android and iOS with a single codebase. With smartphone penetration growing rapidly across Uganda and the region — where Android dominates with over 80% market share — businesses can reach the widest possible audience without maintaining separate development teams.</p><h3>Fast Development for the African Market</h3><p>Flutter\'s hot reload feature allows developers in Kampala to see changes in real-time, dramatically speeding up the development process. For startups and businesses that need to move fast in the competitive East African market, this means faster time-to-market and lower development costs.</p><h3>Native Performance on All Devices</h3><p>Unlike hybrid frameworks that compromise on performance, Flutter compiles to native ARM code. This means mobile apps built with Flutter perform excellently even on mid-range Android devices common across Uganda and East Africa, providing a smooth user experience without lag or jank.</p><h3>Rich UI Components for Modern Apps</h3><p>Flutter\'s widget-based architecture makes it easy to create beautiful, responsive user interfaces. From fintech apps that need MTN MoMo and Airtel Money integration to e-commerce platforms serving customers across the region, Flutter provides the UI flexibility to create compelling mobile experiences.</p><h3>Cost-Effective for African Businesses</h3><p>For businesses in Uganda and East Africa, budget is often a primary concern. Flutter reduces development costs by eliminating the need for separate iOS and Android teams. A single Flutter developer or team can deliver a complete mobile application, making professional app development accessible to more businesses in Kampala and beyond.</p><h3>Growing Demand for Mobile Apps</h3><p>East Africa has one of the fastest-growing mobile internet user bases in the world. From mobile money (MTN MoMo, Airtel Money, M-Pesa) to mobile-first e-commerce and service platforms, the demand for mobile apps in Uganda and neighboring countries is exploding. Flutter positions businesses to capture this growing market.</p><h2>Getting Started with Flutter in Uganda</h2><p>If you are a business owner in Kampala or across Uganda looking to build a mobile app, hiring a Flutter developer with local market knowledge is your first step. A developer who understands the East African mobile ecosystem — including payment integrations, local preferences, and network conditions — will deliver a better product for your target audience.</p>',
            'meta_title' => 'Building Cross-Platform Mobile Apps with Flutter for East African Businesses',
            'meta_description' => 'Learn how Flutter mobile app development is helping businesses in Uganda, Kenya, Tanzania, and East Africa build native-quality Android and iOS apps cost-effectively.',
            'meta_keywords' => 'Flutter Uganda, cross-platform apps East Africa, mobile app development Kampala, Flutter developer Uganda, Android iOS apps Uganda, mobile apps East Africa, Flutter Dart Uganda',
            'schema_type' => 'TechArticle',
            'robots' => 'index,follow',
            'reading_time_minutes' => 6,
            'status' => 'published',
            'published_at' => $now->copy()->subDays(1),
            'is_featured' => true,
            'include_in_sitemap' => true,
            'include_in_feed' => true,
            'author_name' => 'Jjuuko Ronald',
            'sitemap_priority' => 0.9,
            'sitemap_changefreq' => 'monthly',
        ]);

        $post2->tags()->sync([$flutter->id, $mobileTag->id, $uganda->id, $eastAfrica->id, $business->id]);
    }
}
