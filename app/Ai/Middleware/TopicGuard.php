<?php

namespace App\Ai\Middleware;

use Closure;
use Laravel\Ai\Prompts\AgentPrompt;
use Laravel\Ai\Responses\AgentResponse;
use Laravel\Ai\Responses\Data\Meta;
use Laravel\Ai\Responses\Data\Usage;

class TopicGuard
{
    protected array $allowedTopics = [
        'Ronnie', 'jjuuko', 'techtower', 'portfolio', 'project', 'service',
        'hire', 'work', 'developer', 'web', 'design', 'laravel', 'react',
        'alpine', 'tailwind', 'css', 'javascript', 'php', 'frontend', 'backend',
        'fullstack', 'full-stack', 'website', 'landing', 'dashboard', 'api',
        'pricing', 'quote', 'cost', 'budget', 'timeline', 'available',
        'experience', 'skill', 'novas', 'uganda', 'contact', 'email',
        'technology', 'framework', 'cms', 'ecommerce', 'saas', 'platform',
        'build', 'create', 'develop', 'code', 'deploy', 'host',
        'maintenance', 'support', 'optimize', 'performance', 'seo',
        'responsive', 'mobile', 'freelance', 'remote', 'collaboration',
        'integration', 'database', 'security', 'authentication',
    ];

    protected array $rejectedTopics = [
        'recipe', 'cooking', 'weather', 'sports', 'politics', 'celebrity',
        'movie', 'film', 'music', 'game', 'gaming', 'joke', 'homework',
        'essay', 'medical', 'health', 'diagnosis', 'legal advice',
        'stock', 'crypto', 'trading', 'relationship', 'dating',
    ];

    public function handle(AgentPrompt $prompt, Closure $next)
    {
        $text = mb_strtolower($prompt->prompt);

        foreach ($this->rejectedTopics as $topic) {
            if (str_contains($text, $topic)) {
                return $this->reject();
            }
        }

        foreach ($this->allowedTopics as $topic) {
            if (str_contains($text, $topic)) {
                return $next($prompt);
            }
        }

        $greetings = ['hello', 'hi ', 'hey', 'good morning', 'good afternoon', 'good evening', 'howdy', 'greetings'];
        foreach ($greetings as $greeting) {
            if (str_starts_with($text, $greeting) || str_starts_with(trim($text), $greeting)) {
                return $next($prompt);
            }
        }

        return $this->reject();
    }

    protected function reject(): AgentResponse
    {
        return new AgentResponse(
            invocationId: 'rejected',
            text: "I'm Kclich, Ronnie's portfolio assistant. I can help with questions about Ronnie's skills, services, projects, or how to work with him. What would you like to know?",
            usage: new Usage,
            meta: new Meta,
        );
    }
}
