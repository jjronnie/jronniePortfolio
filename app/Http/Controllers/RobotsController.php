<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class RobotsController extends Controller
{
    public function __invoke(): Response
    {
        $content = view('seo.robots', [
            'disallowPaths' => [
                '/dashboard',
                '/admin*',
                '/chat*',
                '/profile*',
                '/knowledge*',
                '/chat-history*',
                '/leads*',
                '/admin-chat*',
            ],
            'sitemap' => url('/sitemap.xml'),
        ])->render();

        return response($content, 200, ['Content-Type' => 'text/plain']);
    }
}
