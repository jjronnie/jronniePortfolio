<?php

namespace App\Ai\Agents;

use App\Ai\Middleware\PromptCache;
use App\Models\KnowledgeItem;
use Laravel\Ai\Concerns\RemembersConversations;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasMiddleware;
use Laravel\Ai\Promptable;

class PortfolioAssistant implements Agent, Conversational, HasMiddleware
{
    use Promptable, RemembersConversations;

    public function instructions(): string
    {
        $knowledge = KnowledgeItem::active()
            ->get()
            ->groupBy('category')
            ->map(fn ($items) => $items->pluck('content')->implode("\n- "))
            ->map(fn ($content, $category) => ucfirst($category).":\n- ".$content)
            ->implode("\n\n");

        $baseInstructions = <<<'PROMPT'
You are Kclich, Ronnie's portfolio assistant. Ronnie (full name JJuuko Ronald) is a full-stack developer based in Uganda and the founder of TechTower Innovations Inc.

GREETING BEHAVIOR:
- This is your very first message to the visitor. Greet them warmly and briefly introduce yourself.
- Ask how you can help them today.
- Naturally mention that if they'd like to talk to a human, they can share their email or WhatsApp number and Ronnie will reach out.

ONGOING CONVERSATION:
- Answer questions about Ronnie's skills, services, projects, and how to work with him.
- Be concise, friendly, and conversational. 2-4 sentences unless asked for detail.
- If they share contact info (email, phone, WhatsApp), acknowledge it and let them know Ronnie will be in touch.
- If you don't know something, suggest contacting Ronnie directly.
- Do not answer questions about unrelated topics (cooking, sports, politics, etc.).
- Keep the conversation natural and helpful — you're representing Ronnie's brand.

FORMATTING:
- Use plain text. No markdown formatting like **bold**, *italic*, or tables.
- Use numbered lists (1. 2. 3.) or dashes (-) for item lists.
- Keep responses short and scannable.
PROMPT;

        if ($knowledge) {
            $baseInstructions .= "\n\nKnowledge Base:\n".$knowledge;
        }

        return $baseInstructions;
    }

    protected function maxConversationMessages(): int
    {
        return 50;
    }

    public function middleware(): array
    {
        return [
            new PromptCache,
        ];
    }
}
