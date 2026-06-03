<?php

use RalphJSmit\Laravel\SEO\Models\SEO;

return [
    'model' => SEO::class,

    'site_name' => 'Jjuuko Ronald',

    'sitemap' => '/sitemap.xml',

    'canonical_link' => true,

    'robots' => [
        'default' => 'index, follow',
        'force_default' => false,
    ],

    'favicon' => 'assets/img/favicon.png',

    'title' => [
        'infer_title_from_url' => true,
        'suffix' => ' | Jjuuko Ronald — Website & Mobile App Developer Uganda',
        'separator' => ' | ',
        'homepage_title' => null,
    ],

    'description' => [
        'fallback' => 'Jjuuko Ronald is a website and mobile app developer based in Kampala, Uganda, specializing in custom websites, cross-platform mobile apps, and web applications for businesses across East Africa.',
    ],

    'image' => [
        'fallback' => 'images/og-default.jpg',
    ],

    'author' => [
        'fallback' => 'Jjuuko Ronald',
    ],

    'twitter' => [
        '@username' => null,
    ],
];
