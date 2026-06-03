<?php

use Spatie\Sitemap\Crawler\Profile;

return [
    'guzzle_options' => [
    ],

    'execute_javascript' => false,

    'chrome_binary_path' => null,

    'crawl_profile' => Profile::class,
];
