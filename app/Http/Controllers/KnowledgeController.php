<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeItem;
use Illuminate\Http\Request;

class KnowledgeController extends Controller
{
    public function index(Request $request)
    {
        $items = KnowledgeItem::query()
            ->when($request->input('search'), fn ($q, $s) => $q->where('content', 'like', "%{$s}%"))
            ->when($request->input('category'), fn ($q, $c) => $q->where('category', $c))
            ->orderBy('category')
            ->orderByDesc('updated_at')
            ->paginate(20)
            ->withQueryString();

        $categories = KnowledgeItem::distinct()->pluck('category');

        return view('knowledge.index', compact('items', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => ['required', 'string', 'max:50'],
            'content' => ['required', 'string', 'max:5000'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        KnowledgeItem::create($validated);

        return redirect()->route('knowledge.index')->with('status', 'Knowledge item added.');
    }

    public function update(Request $request, KnowledgeItem $knowledge)
    {
        $validated = $request->validate([
            'category' => ['required', 'string', 'max:50'],
            'content' => ['required', 'string', 'max:5000'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $knowledge->update($validated);

        return redirect()->route('knowledge.index')->with('status', 'Knowledge item updated.');
    }

    public function destroy(KnowledgeItem $knowledge)
    {
        $knowledge->delete();

        return redirect()->route('knowledge.index')->with('status', 'Knowledge item deleted.');
    }
}
