<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('agent_conversations')
            ->leftJoin('agent_conversation_messages', 'agent_conversations.id', '=', 'agent_conversation_messages.conversation_id')
            ->select(
                'agent_conversations.id',
                'agent_conversations.title',
                'agent_conversations.user_id',
                'agent_conversations.created_at',
                DB::raw('COUNT(agent_conversation_messages.id) as message_count')
            )
            ->groupBy(
                'agent_conversations.id',
                'agent_conversations.title',
                'agent_conversations.user_id',
                'agent_conversations.created_at'
            );

        if ($request->input('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('agent_conversations.title', 'like', "%{$search}%")
                    ->orWhereIn('agent_conversations.id', function ($sub) use ($search) {
                        $sub->select('conversation_id')
                            ->from('agent_conversation_messages')
                            ->where('content', 'like', "%{$search}%");
                    });
            });
        }

        $conversations = $query
            ->orderByDesc('agent_conversations.updated_at')
            ->paginate(20)
            ->withQueryString();

        return view('chat-history.index', compact('conversations'));
    }

    public function show(string $id)
    {
        $conversation = DB::table('agent_conversations')->where('id', $id)->first();

        if (! $conversation) {
            abort(404);
        }

        $messages = DB::table('agent_conversation_messages')
            ->where('conversation_id', $id)
            ->orderBy('created_at')
            ->get();

        return view('chat-history.show', compact('conversation', 'messages'));
    }

    public function destroy(string $id)
    {
        DB::table('agent_conversation_messages')->where('conversation_id', $id)->delete();
        DB::table('agent_conversations')->where('id', $id)->delete();

        return redirect()->route('chat-history.index')->with('status', 'Conversation deleted.');
    }
}
