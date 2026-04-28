<?php

namespace App\Http\Controllers;

use App\Ai\Agents\AdminAssistant;
use App\Models\ChatLead;
use App\Models\KnowledgeItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Ai\Responses\StreamedAgentResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminChatController extends Controller
{
    protected const DELETE_PASSCODE = '8892';

    public function view()
    {
        return view('admin-chat.index');
    }

    public function stream(Request $request)
    {
        $validated = $request->validate([
            'prompt' => ['required', 'string', 'max:4000'],
            'conversation_id' => ['nullable', 'string'],
        ]);

        $prompt = $validated['prompt'];
        $promptLower = mb_strtolower(trim($prompt));

        // Handle knowledge CRUD locally first (no API call)
        $localResult = $this->handleLocalCommand($prompt, $promptLower);

        if ($localResult !== null) {
            return $this->streamText($localResult, $validated['conversation_id'] ?? null, $prompt);
        }

        // Auto-detect teaching moments and store as knowledge
        $this->autoLearn($prompt);

        // Build context with latest data
        $context = $this->buildContext();
        $enrichedPrompt = $context."\n\nAdmin question: ".$prompt;

        $agent = new AdminAssistant;

        if (! empty($validated['conversation_id'])) {
            $existing = DB::table('agent_conversations')->where('id', $validated['conversation_id'])->first();
            if ($existing) {
                $agent->continue($validated['conversation_id'], (object) ['id' => null]);
            }
        }

        if (empty($agent->currentConversation())) {
            $conversationId = (string) Str::uuid7();
            DB::table('agent_conversations')->insert([
                'id' => $conversationId,
                'user_id' => null,
                'title' => Str::limit($prompt, 100, preserveWords: true),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $agent->continue($conversationId, (object) ['id' => null]);
        }

        $activeConversationId = $agent->currentConversation();
        $stream = $agent->stream($enrichedPrompt)->usingVercelDataProtocol();

        $assistantText = '';
        $responseConversationId = null;

        $stream->then(function (StreamedAgentResponse $response) use (&$responseConversationId) {
            $responseConversationId = $response->conversationId;
        });

        $closure = function () use ($stream, $activeConversationId, $prompt, &$assistantText, &$responseConversationId) {
            foreach ($stream as $event) {
                $data = $event->toVercelProtocolArray();

                if ($data !== null) {
                    if ($data['type'] === 'text-delta' && ! empty($data['delta'])) {
                        $assistantText .= $data['delta'];
                    }

                    yield 'data: '.json_encode($data)."\n\n";
                }
            }

            $cid = $activeConversationId ?: $responseConversationId;

            yield 'data: '.json_encode([
                'type' => 'message-annotations',
                'annotations' => [['conversationId' => $cid]],
            ])."\n\n";

            if ($cid) {
                $now = now();

                DB::table('agent_conversation_messages')->insert([
                    'id' => (string) Str::uuid7(),
                    'conversation_id' => $cid,
                    'user_id' => null,
                    'agent' => 'admin-assistant',
                    'role' => 'user',
                    'content' => $prompt,
                    'attachments' => '[]',
                    'tool_calls' => '[]',
                    'tool_results' => '[]',
                    'usage' => '{}',
                    'meta' => '{}',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                DB::table('agent_conversation_messages')->insert([
                    'id' => (string) Str::uuid7(),
                    'conversation_id' => $cid,
                    'user_id' => null,
                    'agent' => 'admin-assistant',
                    'role' => 'assistant',
                    'content' => $assistantText,
                    'attachments' => '[]',
                    'tool_calls' => '[]',
                    'tool_results' => '[]',
                    'usage' => '{}',
                    'meta' => '{}',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                DB::table('agent_conversations')
                    ->where('id', $cid)
                    ->update(['updated_at' => $now]);
            }

            yield "data: [DONE]\n\n";
        };

        return response()->stream($closure, headers: [
            'Cache-Control' => 'no-cache, no-transform',
            'Content-Type' => 'text/event-stream',
            'x-vercel-ai-ui-message-stream' => 'v1',
        ]);
    }

    protected function handleLocalCommand(string $prompt, string $promptLower): ?string
    {
        // ADD knowledge
        if (preg_match('/^add\s+knowledge\s*(?:\[([^\]]+)\])?\s*:?\s*(.+)/si', $prompt, $m)) {
            $category = $m[1] ?? 'general';
            $content = trim($m[2]);

            if (strlen($content) < 3) {
                return 'Please provide more detail for the knowledge item.';
            }

            $item = KnowledgeItem::create([
                'category' => mb_strtolower(trim($category)),
                'content' => $content,
                'is_active' => true,
            ]);

            return "Added knowledge item #{$item->id} [{$item->category}]: {$item->content}";
        }

        // LIST knowledge
        if (preg_match('/^(list|show|view)\s+(all\s+)?knowledge/i', $prompt)) {
            $items = KnowledgeItem::orderBy('category')->orderByDesc('updated_at')->get();

            if ($items->isEmpty()) {
                return 'No knowledge items yet. Use "add knowledge [category]: content" to create one.';
            }

            $lines = ["Knowledge Base ({$items->count()} items):\n"];
            foreach ($items as $item) {
                $status = $item->is_active ? 'active' : 'off';
                $lines[] = "#{$item->id} [{$item->category}] ({$status}): {$item->content}";
            }

            return implode("\n", $lines);
        }

        // EDIT knowledge
        if (preg_match('/^(?:edit|update)\s+knowledge\s+#?(\d+)\s*:?\s*(.+)/si', $prompt, $m)) {
            $id = (int) $m[1];
            $content = trim($m[2]);

            $item = KnowledgeItem::find($id);
            if (! $item) {
                return "Knowledge item #{$id} not found.";
            }

            // Check for category change: [category] content
            if (preg_match('/^\[([^\]]+)\]\s*(.+)/', $content, $catMatch)) {
                $item->category = mb_strtolower(trim($catMatch[1]));
                $content = trim($catMatch[2]);
            }

            $item->content = $content;
            $item->save();

            return "Updated knowledge #{$item->id} [{$item->category}]: {$item->content}";
        }

        // TOGGLE knowledge active/inactive
        if (preg_match('/^(?:toggle|activate|deactivate|enable|disable)\s+knowledge\s+#?(\d+)/i', $prompt, $m)) {
            $id = (int) $m[1];
            $item = KnowledgeItem::find($id);
            if (! $item) {
                return "Knowledge item #{$id} not found.";
            }

            if (preg_match('/^(?:deactivate|disable)/i', $prompt)) {
                $item->is_active = false;
            } elseif (preg_match('/^(?:activate|enable)/i', $prompt)) {
                $item->is_active = true;
            } else {
                $item->is_active = ! $item->is_active;
            }

            $item->save();
            $status = $item->is_active ? 'active' : 'inactive';

            return "Knowledge #{$item->id} is now {$status}.";
        }

        // DELETE knowledge — requires passcode
        if (preg_match('/^delete\s+knowledge\s+#?(\d+)/i', $prompt, $m)) {
            $id = (int) $m[1];
            $item = KnowledgeItem::find($id);
            if (! $item) {
                return "Knowledge item #{$id} not found.";
            }

            // Check for passcode in prompt
            if (str_contains($prompt, self::DELETE_PASSCODE)) {
                $item->delete();

                return "Deleted knowledge #{$id} [{$item->category}]: {$item->content}";
            }

            // No passcode — ask AI to request it
            return null;
        }

        // Passcode-only message (user responding to a delete request)
        if (preg_match('/^\d{3,6}$/', trim($prompt))) {
            if (trim($prompt) === self::DELETE_PASSCODE) {
                return 'Passcode accepted. Please tell me which knowledge item to delete (e.g., "delete knowledge #5").';
            }

            return 'Wrong passcode. Deletion aborted.';
        }

        return null;
    }

    protected function autoLearn(string $prompt): void
    {
        $patterns = [
            '/(?:ronnie|he)\s+(?:charges?|costs?|prices?|quotes?)\s+(.+)/i',
            '/(?:pricing|rate|fee|cost)\s+(?:is|:)\s+(.+)/i',
            '/(?:ronnie|he)\s+(?:offers?|provides?|does?|builds?|specializes?\s+in)\s+(.+)/i',
            '/(?:new|added)\s+service\s*:?\s*(.+)/i',
            '/(?:project|work)\s*:?\s*(.+)/i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $prompt, $m)) {
                $existing = KnowledgeItem::where('content', 'like', '%'.mb_substr(trim($m[1]), 0, 30).'%')->first();

                if (! $existing) {
                    KnowledgeItem::create([
                        'category' => 'learned',
                        'content' => trim($m[1]),
                        'is_active' => true,
                    ]);
                }

                break;
            }
        }
    }

    protected function streamText(string $text, ?string $conversationId, string $originalPrompt): StreamedResponse
    {
        $words = explode(' ', $text);

        return response()->stream(function () use ($words, $conversationId, $originalPrompt) {
            $cid = $conversationId;
            if (! $cid) {
                $cid = (string) Str::uuid7();
                DB::table('agent_conversations')->insert([
                    'id' => $cid,
                    'user_id' => null,
                    'title' => Str::limit($originalPrompt, 100, preserveWords: true),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            yield 'data: '.json_encode(['type' => 'start', 'messageId' => 'local'])."\n\n";

            $fullText = '';
            foreach ($words as $word) {
                yield 'data: '.json_encode(['type' => 'text-delta', 'id' => 'local', 'delta' => $word.' '])."\n\n";
                $fullText .= $word.' ';
                usleep(20000);
            }

            yield 'data: '.json_encode(['type' => 'finish'])."\n\n";

            yield 'data: '.json_encode([
                'type' => 'message-annotations',
                'annotations' => [['conversationId' => $cid]],
            ])."\n\n";

            $now = now();
            DB::table('agent_conversation_messages')->insert([
                'id' => (string) Str::uuid7(), 'conversation_id' => $cid, 'user_id' => null,
                'agent' => 'admin-assistant', 'role' => 'user', 'content' => $originalPrompt,
                'attachments' => '[]', 'tool_calls' => '[]', 'tool_results' => '[]',
                'usage' => '{}', 'meta' => '{}', 'created_at' => $now, 'updated_at' => $now,
            ]);
            DB::table('agent_conversation_messages')->insert([
                'id' => (string) Str::uuid7(), 'conversation_id' => $cid, 'user_id' => null,
                'agent' => 'admin-assistant', 'role' => 'assistant', 'content' => trim($fullText),
                'attachments' => '[]', 'tool_calls' => '[]', 'tool_results' => '[]',
                'usage' => '{}', 'meta' => '{}', 'created_at' => $now, 'updated_at' => $now,
            ]);
            DB::table('agent_conversations')->where('id', $cid)->update(['updated_at' => $now]);

            yield "data: [DONE]\n\n";
        }, headers: [
            'Cache-Control' => 'no-cache, no-transform',
            'Content-Type' => 'text/event-stream',
            'x-vercel-ai-ui-message-stream' => 'v1',
        ]);
    }

    protected function buildContext(): string
    {
        $lines = [];

        $todayConversations = DB::table('agent_conversations')->whereDate('created_at', today())->count();
        $todayMessages = DB::table('agent_conversation_messages')->whereDate('created_at', today())->count();
        $totalConversations = DB::table('agent_conversations')->count();
        $totalMessages = DB::table('agent_conversation_messages')->count();
        $totalLeads = ChatLead::count();

        $lines[] = "=== TODAY'S STATS ===";
        $lines[] = "New conversations today: {$todayConversations}";
        $lines[] = "Messages today: {$todayMessages}";
        $lines[] = "Total conversations (all time): {$totalConversations}";
        $lines[] = "Total messages (all time): {$totalMessages}";
        $lines[] = "Total leads: {$totalLeads}";

        $todayConvos = DB::table('agent_conversations')
            ->whereDate('created_at', today())
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        if ($todayConvos->isNotEmpty()) {
            $lines[] = "\n=== TODAY'S CONVERSATIONS ===";
            foreach ($todayConvos as $c) {
                $msgCount = DB::table('agent_conversation_messages')->where('conversation_id', $c->id)->count();
                $lines[] = "- {$c->title} ({$msgCount} messages)";
            }
        }

        $recentLeads = ChatLead::latest()->limit(10)->get();
        if ($recentLeads->isNotEmpty()) {
            $lines[] = "\n=== RECENT LEADS ===";
            foreach ($recentLeads as $lead) {
                $lines[] = "- {$lead->name} | {$lead->contact} | {$lead->topic} | {$lead->created_at}";
            }
        }

        $knowledge = KnowledgeItem::orderBy('category')->orderByDesc('updated_at')->get();
        if ($knowledge->isNotEmpty()) {
            $lines[] = "\n=== KNOWLEDGE BASE ({$knowledge->count()} items) ===";
            foreach ($knowledge as $item) {
                $status = $item->is_active ? 'active' : 'off';
                $lines[] = "#{$item->id} [{$item->category}] ({$status}): {$item->content}";
            }
        }

        return implode("\n", $lines);
    }
}
