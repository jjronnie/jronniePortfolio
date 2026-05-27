<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function index(): View
    {
        $skills = Skill::orderBy('sort_order')->get();

        return view('admin.skills.index', compact('skills'));
    }

    public function create(): View
    {
        return view('admin.skills.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:skills,slug'],
            'category' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'percentage' => ['required', 'integer', 'min:0', 'max:100'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Skill::create($validated);

        return to_route('admin.skills.index')->with('status', 'Skill created successfully.');
    }

    public function edit(Skill $skill): View
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:skills,slug,'.$skill->id],
            'category' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'percentage' => ['required', 'integer', 'min:0', 'max:100'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $skill->update($validated);

        return to_route('admin.skills.index')->with('status', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return to_route('admin.skills.index')->with('status', 'Skill deleted successfully.');
    }
}
