<?php

namespace App\Services;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Tag;
use RalphJSmit\Laravel\SEO\Schema\ArticleSchema;
use RalphJSmit\Laravel\SEO\Schema\BreadcrumbListSchema;
use RalphJSmit\Laravel\SEO\SchemaCollection;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class SeoService
{
    protected array $identity = [
        'name' => 'Jjuuko Ronald',
        'jobTitle' => 'Website & Mobile App Developer',
        'description' => 'Website and mobile application developer based in Kampala, Uganda. Specializes in custom websites, cross-platform mobile apps, and web applications for businesses across Uganda and East Africa.',
        'email' => 'ronaldjjuuko7@gmail.com',
        'telephone' => '+256703283529',
        'url' => null,
        'sameAs' => [],
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Kampala',
            'addressRegion' => 'Central Region',
            'addressCountry' => 'UG',
        ],
        'areaServed' => [
            'Uganda', 'East Africa', 'Kenya', 'Tanzania', 'Rwanda', 'Africa',
        ],
        'knowsAbout' => [
            'Laravel', 'PHP', 'React', 'Vue.js', 'Flutter', 'Dart',
            'JavaScript', 'TypeScript', 'MySQL', 'PostgreSQL', 'Firebase',
            'Docker', 'Linux', 'GitHub Actions', 'Redis', 'Tailwind CSS',
            'WordPress', 'HTML', 'CSS', 'Google Analytics', 'Google Search Console',
            'Web Development', 'Mobile App Development', 'Software Development Uganda',
            'Website Design Uganda', 'Web Application Development East Africa',
        ],
    ];

    public function __construct()
    {
        $this->identity['url'] = config('app.url');
    }

    protected function basePersonSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => $this->identity['name'],
            'jobTitle' => $this->identity['jobTitle'],
            'description' => $this->identity['description'],
            'email' => $this->identity['email'],
            'telephone' => $this->identity['telephone'],
            'url' => $this->identity['url'],
            'address' => $this->identity['address'],
            'knowsAbout' => $this->identity['knowsAbout'],
            'sameAs' => $this->identity['sameAs'],
        ];
    }

    public function homeSeoData(): SEOData
    {
        return new SEOData(
            title: 'Jjuuko Ronald | Website & Mobile App Developer Uganda',
            description: 'Jjuuko Ronald is a website and mobile app developer based in Kampala, Uganda. Building custom websites, cross-platform mobile apps, and web applications for businesses in Uganda and East Africa since 2022.',
            image: '/images/og-home.svg',
            enableTitleSuffix: false,
            schema: $this->homeSchema(),
        );
    }

    protected function homeSchema(): SchemaCollection
    {
        $collection = SchemaCollection::initialize();

        $collection->push(fn () => $this->basePersonSchema());

        $collection->push(fn () => [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'Jjuuko Ronald | Website & Mobile App Developer Uganda',
            'url' => $this->identity['url'],
            'description' => $this->identity['description'],
            'author' => ['@type' => 'Person', 'name' => $this->identity['name']],
        ]);

        $collection->push(fn () => [
            '@context' => 'https://schema.org',
            '@type' => 'ProfessionalService',
            'name' => 'Jjuuko Ronald | Website & Mobile App Development Services',
            'description' => 'Custom website and mobile application development services in Uganda and East Africa.',
            'url' => $this->identity['url'],
            'email' => $this->identity['email'],
            'telephone' => $this->identity['telephone'],
            'areaServed' => $this->identity['areaServed'],
            'address' => $this->identity['address'],
        ]);

        return $collection;
    }

    public function aboutSeoData(): SEOData
    {
        return new SEOData(
            title: 'About Jjuuko Ronald',
            description: 'Learn about Jjuuko Ronald, a website and mobile app developer from Kampala, Uganda with expertise in custom websites, cross-platform mobile apps, and web applications. Building for Uganda and East Africa since 2022.',
            image: '/images/og-about.svg',
            schema: $this->aboutSchema(),
        );
    }

    protected function aboutSchema(): SchemaCollection
    {
        $collection = SchemaCollection::initialize();
        $collection->push(fn () => $this->basePersonSchema());

        return $collection;
    }

    public function servicesSeoData(): SEOData
    {
        return new SEOData(
            title: 'Services | Website & Mobile App Development Uganda',
            description: 'Professional website development, mobile app development, and software consulting services in Uganda and East Africa. Custom solutions for businesses in Kampala and beyond.',
            image: '/images/og-services.svg',
            schema: $this->servicesSchema(),
        );
    }

    protected function servicesSchema(): SchemaCollection
    {
        $collection = SchemaCollection::initialize();
        $baseUrl = $this->identity['url'];

        $services = [
            [
                'name' => 'Website Design & Development Uganda',
                'description' => 'Professional, fast, and SEO-optimized websites for businesses in Uganda. Built with Laravel, React, or WordPress.',
                'url' => $baseUrl.'/services#website-development',
            ],
            [
                'name' => 'Web Application Development Uganda',
                'description' => 'Custom web applications built with Laravel and React for businesses across Uganda and East Africa. SaaS, CRMs, dashboards, POS systems.',
                'url' => $baseUrl.'/services#web-applications',
            ],
            [
                'name' => 'Mobile App Development Uganda',
                'description' => 'Cross-platform mobile apps for Android and iOS using Flutter. Built for Ugandan and East African market needs.',
                'url' => $baseUrl.'/services#mobile-apps',
            ],
            [
                'name' => 'SEO Services Uganda',
                'description' => 'Technical SEO, content strategy, and Google Search Console optimization for businesses in Uganda and East Africa.',
                'url' => $baseUrl.'/services#seo',
            ],
            [
                'name' => 'API Development & Integration',
                'description' => 'RESTful API development and third-party integrations including MTN MoMo, Airtel Money, and other East African payment systems.',
                'url' => $baseUrl.'/services#api-development',
            ],
        ];

        foreach ($services as $service) {
            $collection->push(fn () => [
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => $service['name'],
                'description' => $service['description'],
                'url' => $service['url'],
                'provider' => ['@type' => 'Person', 'name' => $this->identity['name'], 'url' => $baseUrl],
                'areaServed' => $this->identity['areaServed'],
            ]);
        }

        return $collection;
    }

    public function projectsSeoData(): SEOData
    {
        return new SEOData(
            title: 'Portfolio | Websites & Mobile Apps',
            description: 'Explore projects by Jjuuko Ronald | custom websites, cross-platform mobile apps, and web applications built for clients in Uganda and East Africa.',
            image: '/images/og-projects.svg',
            schema: $this->projectsIndexSchema(),
        );
    }

    protected function projectsIndexSchema(): SchemaCollection
    {
        $collection = SchemaCollection::initialize();
        $collection->push(fn () => [
            '@context' => 'https://schema.org',
            '@type' => 'CreativeWork',
            'name' => 'Portfolio of Jjuuko Ronald | Website & Mobile App Developer Uganda',
            'description' => 'A collection of websites, mobile apps, and web applications developed by Jjuuko Ronald for clients in Uganda and East Africa.',
            'url' => $this->identity['url'].'/projects',
            'author' => ['@type' => 'Person', 'name' => $this->identity['name'], 'url' => $this->identity['url']],
        ]);

        return $collection;
    }

    public function projectSeoData(array $project): SEOData
    {
        $title = ($project['name'] ?? 'Project').' | Jjuuko Ronald';
        $description = $project['description']
            ?? 'A project built by Jjuuko Ronald, website and mobile app developer from Kampala, Uganda.';

        return new SEOData(
            title: $title,
            description: mb_substr($description, 0, 155),
            image: $project['image'] ?? '/images/og-projects.svg',
            schema: $this->singleProjectSchema($project),
        );
    }

    protected function singleProjectSchema(array $project): SchemaCollection
    {
        $collection = SchemaCollection::initialize();
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'SoftwareApplication',
            'name' => $project['name'] ?? '',
            'description' => $project['description'] ?? '',
            'author' => ['@type' => 'Person', 'name' => $this->identity['name'], 'url' => $this->identity['url']],
            'url' => $project['liveUrl'] ?? $this->identity['url'].'/projects',
        ];

        if (! empty($project['technologies'])) {
            $schema['keywords'] = implode(', ', $project['technologies']);
        }

        $collection->push(fn () => $schema);

        return $collection;
    }

    public function contactSeoData(): SEOData
    {
        return new SEOData(
            title: 'Contact Jjuuko Ronald',
            description: 'Get in touch with Jjuuko Ronald | hire a website and mobile app developer in Uganda for your website, mobile app, or web application project. Based in Kampala, serving East Africa.',
            image: '/images/og-contact.svg',
            schema: $this->contactSchema(),
        );
    }

    protected function contactSchema(): SchemaCollection
    {
        $collection = SchemaCollection::initialize();
        $collection->push(fn () => [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => $this->identity['name'],
            'email' => $this->identity['email'],
            'telephone' => $this->identity['telephone'],
            'url' => $this->identity['url'],
            'address' => $this->identity['address'],
        ]);

        return $collection;
    }

    public function blogIndexSeoData(): SEOData
    {
        return new SEOData(
            title: 'Blog | Website & Mobile App Development',
            description: 'Articles on website development, mobile app development, web applications, and software engineering from Jjuuko Ronald, a developer based in Kampala, Uganda.',
            image: '/images/og-blog.svg',
            schema: $this->blogIndexSchema(),
        );
    }

    protected function blogIndexSchema(): SchemaCollection
    {
        $collection = SchemaCollection::initialize();
        $collection->push(fn () => [
            '@context' => 'https://schema.org',
            '@type' => 'Blog',
            'name' => 'Jjuuko Ronald | Dev Blog',
            'description' => 'Articles on website and mobile app development from a Uganda-based developer.',
            'url' => $this->identity['url'].'/blog',
            'author' => ['@type' => 'Person', 'name' => $this->identity['name'], 'url' => $this->identity['url']],
        ]);

        return $collection;
    }

    public function postSeoData(Post $post): SEOData
    {
        return new SEOData(
            title: $post->getSeoTitle(),
            description: $post->getSeoDescription(),
            image: $post->getOgImage(),
            schema: $this->postSchema($post),
            robots: $post->robots,
            canonical_url: $post->getCanonicalUrl(),
            published_time: $post->published_at,
            modified_time: $post->getLastModified(),
            articleBody: strip_tags($post->body),
            section: $post->category?->name,
            tags: $post->tags->pluck('name')->toArray(),
            author: $post->author_name,
        );
    }

    protected function postSchema(Post $post): SchemaCollection
    {
        $collection = SchemaCollection::initialize();

        $collection->addArticle(function (ArticleSchema $schema) use ($post) {
            $schema->headline = $post->title;
            $schema->description = $post->getSeoDescription();
            $schema->url = route('blog.show', $post->slug);
            $schema->datePublished = $post->published_at;
            $schema->dateModified = $post->getLastModified();
            $schema->addAuthor($post->author_name);
            $schema->image = $post->featured_image;

            if ($post->schema_type === 'TechArticle') {
                $schema->type = 'TechArticle';
            }

            return $schema;
        });

        $collection->addBreadcrumbs(function (BreadcrumbListSchema $schema) use ($post) {
            $schema->appendBreadcrumbs([
                'Home' => $this->identity['url'],
                'Blog' => $this->identity['url'].'/blog',
                $post->title => route('blog.show', $post->slug),
            ]);

            return $schema;
        });

        return $collection;
    }

    public function categorySeoData(PostCategory $category): SEOData
    {
        return new SEOData(
            title: $category->getSeoTitle(),
            description: $category->getSeoDescription(),
            image: $category->og_image ?? '/images/og-blog.svg',
        );
    }

    public function tagSeoData(Tag $tag): SEOData
    {
        return new SEOData(
            title: $tag->getSeoTitle(),
            description: $tag->getSeoDescription(),
            image: '/images/og-blog.svg',
        );
    }
}
