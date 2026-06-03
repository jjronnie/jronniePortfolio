<?php

use App\Models\Post;

return [
    'feeds' => [
        'main' => [
            'items' => [Post::class, 'getFeedItems'],
            'url' => '/feed',
            'title' => 'Jjuuko Ronald — Dev Blog | Laravel, React, Flutter Uganda',
            'description' => 'Technical articles on web and mobile development, Laravel, PHP, React, Flutter, and software engineering by Jjuuko Ronald, full-stack developer in Kampala, Uganda.',
            'language' => 'en',
            'image' => '/images/og-blog.jpg',
            'format' => 'atom',
            'view' => 'feed::atom',
        ],
        'rss' => [
            'items' => [Post::class, 'getFeedItems'],
            'url' => '/rss',
            'title' => 'Jjuuko Ronald — Dev Blog',
            'description' => 'Web development articles from Kampala, Uganda.',
            'language' => 'en',
            'image' => '/images/og-blog.jpg',
            'format' => 'rss',
            'view' => 'feed::rss',
        ],
    ],
];
