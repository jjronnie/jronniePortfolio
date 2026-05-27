<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::orderBy('sort_order')->get();

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:services,slug'],
            'description' => ['required', 'string'],
            'icon_svg' => ['required', 'string'],
            'features' => ['nullable', 'string'],
            'type' => ['required', 'string', 'in:core,beyond'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $validated['features'] = $validated['features']
            ? array_map('trim', explode("\n", $validated['features']))
            : null;

        $validated['is_active'] = $request->boolean('is_active');

        Service::create($validated);

        return to_route('admin.services.index')->with('status', 'Service created successfully.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:services,slug,'.$service->id],
            'description' => ['required', 'string'],
            'icon_svg' => ['required', 'string'],
            'features' => ['nullable', 'string'],
            'type' => ['required', 'string', 'in:core,beyond'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $validated['features'] = $validated['features']
            ? array_map('trim', explode("\n", $validated['features']))
            : null;

        $validated['is_active'] = $request->boolean('is_active');

        $service->update($validated);

        return to_route('admin.services.index')->with('status', 'Service updated successfully.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return to_route('admin.services.index')->with('status', 'Service deleted successfully.');
    }
}
