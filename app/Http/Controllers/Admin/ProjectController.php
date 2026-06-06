<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::orderBy('sort_order')->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        $skills = Skill::active()->ordered()->get();

        return view('admin.projects.create', compact('skills'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:projects,slug'],
            'category' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'project_url' => ['nullable', 'url', 'max:2048'],
            'status' => ['required', 'string', 'in:completed,ongoing'],
            'is_featured' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
            'skills' => ['nullable', 'array'],
            'skills.*' => ['exists:skills,id'],
        ]);

        $validated['description'] = array_map('trim', explode("\n", trim($validated['description'])));
        $validated['tags'] = [];

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        $project = Project::create($validated);

        $project->skills()->sync($request->input('skills', []));

        return to_route('admin.projects.index')->with('status', 'Project created successfully.');
    }

    public function edit(Project $project): View
    {
        $skills = Skill::active()->ordered()->get();

        return view('admin.projects.edit', compact('project', 'skills'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:projects,slug,'.$project->id],
            'category' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'project_url' => ['nullable', 'url', 'max:2048'],
            'status' => ['required', 'string', 'in:completed,ongoing'],
            'is_featured' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
            'skills' => ['nullable', 'array'],
            'skills.*' => ['exists:skills,id'],
        ]);

        $validated['description'] = array_map('trim', explode("\n", trim($validated['description'])));
        $validated['tags'] = [];

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        $project->update($validated);

        $project->skills()->sync($request->input('skills', []));

        return to_route('admin.projects.index')->with('status', 'Project updated successfully.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return to_route('admin.projects.index')->with('status', 'Project deleted successfully.');
    }
}
