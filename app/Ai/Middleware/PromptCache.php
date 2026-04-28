<?php

namespace App\Ai\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Laravel\Ai\Prompts\AgentPrompt;

class PromptCache
{
    public function handle(AgentPrompt $prompt, Closure $next)
    {
        $hash = 'kclich:'.hash('xxh128', mb_strtolower(trim($prompt->prompt)));

        if (Cache::has($hash)) {
            return $next($prompt);
        }

        return $next($prompt)->then(function ($response) use ($hash) {
            if (! empty($response->text)) {
                Cache::put($hash, true, now()->addHours(6));
            }
        });
    }
}
