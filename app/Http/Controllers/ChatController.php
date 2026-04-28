<?php

namespace App\Http\Controllers;

use App\Ai\Agents\PortfolioAssistant;
use App\Models\ChatLead;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected array $rejectedTopics = [
        'recipe', 'cooking', 'weather', 'sports', 'politics', 'celebrity',
        'movie', 'film', 'music', 'game', 'gaming', 'joke', 'homework',
        'essay', 'medical', 'health', 'diagnosis', 'legal advice',
        'stock', 'crypto', 'trading', 'relationship', 'dating',
    ];

    protected array $allowedTopics = [
        'ronald', 'jjuuko', 'ronnie', 'techtower', 'portfolio', 'project', 'service',
        'hire', 'work', 'developer', 'web', 'design', 'laravel', 'react',
        'alpine', 'tailwind', 'css', 'javascript', 'php', 'frontend', 'backend',
        'fullstack', 'full-stack', 'website', 'landing', 'dashboard', 'api',
        'pricing', 'quote', 'cost', 'budget', 'timeline', 'available',
        'experience', 'skill', 'novas', 'uganda', 'contact', 'email',
        'technolog', 'framework', 'cms', 'ecommerce', 'saas', 'platform',
        'build', 'create', 'develop', 'code', 'deploy', 'host',
        'maintenance', 'support', 'optimize', 'performance', 'seo',
        'responsive', 'mobile', 'freelance', 'remote', 'collaboration',
        'integration', 'database', 'security', 'authentication',
    ];

    public function stream(Request $request)
    {
        $validated = $request->validate([
            'prompt' => ['required', 'string', 'max:2000'],
            'conversation_id' => ['nullable', 'string'],
            'lead' => ['nullable', 'array'],
            'lead.name' => ['nullable', 'string', 'max:100'],
            'lead.contact' => ['nullable', 'string', 'max:100'],
            'lead.topic' => ['nullable', 'string', 'max:100'],
        ]);

        $prompt = $validated['prompt'];

        if ($this->isOffTopic($prompt)) {
            return $this->rejectResponse();
        }

        $sessionId = $request->session()->getId();
        $guest = (object) ['id' => null];

        if (! empty($validated['lead'])) {
            ChatLead::updateOrCreate(
                ['session_id' => $sessionId],
                $validated['lead'],
            );
        }

        $agent = new PortfolioAssistant;
        $agent->forUser($guest);

        if (! empty($validated['conversation_id'])) {
            $existing = \DB::table('agent_conversations')->where('id', $validated['conversation_id'])->first();
            if ($existing) {
                $agent->continue($validated['conversation_id'], $guest);
            }
        }

        return $agent->stream($prompt)->usingVercelDataProtocol();
    }

    protected function isOffTopic(string $prompt): bool
    {
        $text = mb_strtolower($prompt);

        foreach ($this->rejectedTopics as $topic) {
            if (str_contains($text, $topic)) {
                return true;
            }
        }

        return false;
    }

    protected function rejectResponse()
    {
        $text = "I'm Kclich, Ronnie's portfolio assistant. I can help with questions about Ronnie's skills, services, projects, or how to work with him. What would you like to know?";

        return response()->stream(function () use ($text) {
            $words = explode(' ', $text);

            yield 'data: '.json_encode(['type' => 'start', 'messageId' => 'rejected'])."\n\n";

            foreach ($words as $word) {
                yield 'data: '.json_encode(['type' => 'text-delta', 'id' => 'rejected', 'delta' => $word.' '])."\n\n";
                usleep(30000);
            }

            yield 'data: '.json_encode(['type' => 'finish'])."\n\n";
            yield "data: [DONE]\n\n";
        }, headers: [
            'Cache-Control' => 'no-cache, no-transform',
            'Content-Type' => 'text/event-stream',
            'x-vercel-ai-ui-message-stream' => 'v1',
        ]);
    }
}
