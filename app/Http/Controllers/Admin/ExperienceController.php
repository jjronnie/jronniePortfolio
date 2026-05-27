<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    public function index(): View
    {
        $experiences = Experience::orderBy('sort_order')->get();

        return view('admin.experiences.index', compact('experiences'));
    }

    public function create(): View
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'string', 'in:work,education'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'string', 'max:255'],
            'end_date' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'points' => ['nullable', 'string'],
            'tags' => ['nullable', 'string'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $validated['points'] = $validated['points']
            ? array_map('trim', explode("\n", $validated['points']))
            : null;

        $validated['tags'] = $validated['tags']
            ? array_map('trim', explode("\n", $validated['tags']))
            : null;

        $validated['is_active'] = $request->boolean('is_active');

        Experience::create($validated);

        return to_route('admin.experiences.index')->with('status', 'Experience created successfully.');
    }

    public function edit(Experience $experience): View
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'string', 'in:work,education'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'string', 'max:255'],
            'end_date' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'points' => ['nullable', 'string'],
            'tags' => ['nullable', 'string'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $validated['points'] = $validated['points']
            ? array_map('trim', explode("\n", $validated['points']))
            : null;

        $validated['tags'] = $validated['tags']
            ? array_map('trim', explode("\n", $validated['tags']))
            : null;

        $validated['is_active'] = $request->boolean('is_active');

        $experience->update($validated);

        return to_route('admin.experiences.index')->with('status', 'Experience updated successfully.');
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();

        return to_route('admin.experiences.index')->with('status', 'Experience deleted successfully.');
    }
}
