<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Response;

class LlmsTxtController extends Controller
{
    public function __invoke(): Response
    {
        $config = config('seo');
        $siteUrl = url('/');

        $lines = [];
        $lines[] = '# '.($config['site_name'] ?? config('app.name'));
        $lines[] = '';
        $lines[] = '> '.($config['description']['fallback'] ?? 'Website and mobile app developer based in Kampala, Uganda.');
        $lines[] = '';
        $lines[] = '## About';
        $lines[] = '';
        $lines[] = 'Jjuuko Ronald is a website and mobile app developer based in Kampala, Uganda, specializing in custom websites, cross-platform mobile apps, and web applications for businesses across Uganda and East Africa.';
        $lines[] = '';
        $lines[] = '## Services';
        $lines[] = '';

        Service::active()->ordered()->each(function (Service $service) use (&$lines) {
            $lines[] = "- **{$service->title}**: {$service->description}";
        });

        $lines[] = '';
        $lines[] = '## Featured Projects';
        $lines[] = '';

        Project::active()->featured()->ordered()->each(function (Project $project) use (&$lines) {
            $lines[] = "- **{$project->title}**: {$project->description}";
        });

        $lines[] = '';
        $lines[] = '## Recent Blog Posts';
        $lines[] = '';

        Post::published()->orderByDesc('published_at')->limit(10)->each(function (Post $post) use (&$lines, $siteUrl) {
            $lines[] = "- [{$post->title}]({$siteUrl}/blog/{$post->slug}): {$post->getSeoDescription()}";
        });

        $lines[] = '';
        $lines[] = '## Contact';
        $lines[] = '';
        $lines[] = '- Email: ronaldjjuuko7@gmail.com';
        $lines[] = '- Location: Kampala, Uganda';
        $lines[] = '- Portfolio: '.$siteUrl;
        $lines[] = '- GitHub: https://github.com/jronnie';

        return response(implode("\n", $lines), 200, ['Content-Type' => 'text/plain']);
    }
}
