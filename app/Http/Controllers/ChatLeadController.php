<?php

namespace App\Http\Controllers;

use App\Models\ChatLead;
use Illuminate\Http\Request;

class ChatLeadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'contact' => ['required', 'string', 'max:100'],
            'topic' => ['required', 'string', 'max:100'],
        ]);

        $sessionId = $request->session()->getId();

        $lead = ChatLead::updateOrCreate(
            ['session_id' => $sessionId],
            $validated,
        );

        return response()->json([
            'ok' => true,
            'lead' => $lead,
        ]);
    }

    public function check(Request $request)
    {
        $sessionId = $request->session()->getId();
        $lead = ChatLead::where('session_id', $sessionId)->first();

        return response()->json([
            'exists' => (bool) $lead,
            'lead' => $lead,
        ]);
    }

    public function index(Request $request)
    {
        $leads = ChatLead::query()
            ->when($request->input('search'), function ($q, $s) {
                $q->where(function ($q) use ($s) {
                    $q->where('name', 'like', "%{$s}%")
                        ->orWhere('contact', 'like', "%{$s}%")
                        ->orWhere('topic', 'like', "%{$s}%");
                });
            })
            ->when($request->input('topic'), fn ($q, $t) => $q->where('topic', $t))
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        $topics = ChatLead::distinct()->pluck('topic');

        return view('leads.index', compact('leads', 'topics'));
    }

    public function destroy(ChatLead $lead)
    {
        $lead->delete();

        return redirect()->route('leads.index')->with('status', 'Lead deleted.');
    }
}
