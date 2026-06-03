<?php

namespace App\Ai\Agents;

use App\Ai\Middleware\PromptCache;
use App\Models\Experience;
use App\Models\KnowledgeItem;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
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

        $services = Service::active()
            ->ordered()
            ->get()
            ->map(fn ($s) => $s->title.': '.$s->description)
            ->implode("\n- ");

        $skills = Skill::active()
            ->ordered()
            ->get()
            ->groupBy('category')
            ->map(fn ($items, $cat) => $cat.': '.$items->pluck('name')->implode(', '))
            ->implode("\n");

        $projects = Project::active()
            ->ordered()
            ->get()
            ->map(fn ($p) => $p->title.($p->description ? ': '.$p->description : ''))
            ->implode("\n- ");

        $experiences = Experience::active()
            ->ordered()
            ->get()
            ->map(fn ($e) => $e->title.' at '.$e->subtitle.' ('.$e->start_date.' - '.($e->end_date ?? 'Present').")\n  ".str($e->description)->limit(200))
            ->implode("\n");

        $baseInstructions = <<<'PROMPT'
You are Kclich, Jjuuko Ronald's portfolio assistant. Ronnie is a full-stack website and mobile app developer in Kampala, Uganda, founder of TechTower Innovations Inc.

Be warm, genuine, and conversational — like a knowledgeable team member having a real chat. Vary how you respond; don't repeat the same greeting every time.

You help visitors learn about Ronnie's skills, services, projects, pricing, and how to hire him.

Guidelines:
- Be natural — think, then respond. No forced scripts.
- If someone shares contact info (email, WhatsApp), acknowledge it and say Ronnie will reach out.
- Be concise, but feel free to give detail when asked.
- Plain text only (no markdown bold/italic/tables). Use numbers or dashes for lists.
- Stay on topic: Ronnie's portfolio, services, and work. Decline off-topic politely.
- If you don't know something, suggest contacting Ronnie directly.
PROMPT;

        if ($services) {
            $baseInstructions .= "\n\nServices I Offer:\n- ".$services;
        }

        if ($skills) {
            $baseInstructions .= "\n\nSkills:\n".$skills;
        }

        if ($projects) {
            $baseInstructions .= "\n\nProjects:\n- ".$projects;
        }

        if ($experiences) {
            $baseInstructions .= "\n\nExperience & Background:\n".$experiences;
        }

        if ($knowledge) {
            $baseInstructions .= "\n\nAdditional Knowledge:\n".$knowledge;
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
