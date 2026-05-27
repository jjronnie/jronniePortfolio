<?php

use App\Models\Project;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('lists projects', function () {
    Project::factory()->count(3)->create();

    $this->get(route('admin.projects.index'))
        ->assertSuccessful();
});

it('shows the create form', function () {
    $this->get(route('admin.projects.create'))
        ->assertSuccessful();
});

it('stores a project', function () {
    $data = [
        'title' => 'Test Project',
        'slug' => 'test-project',
        'category' => 'Web',
        'description' => 'A test project description.',
        'tags' => "React\nLaravel",
        'project_url' => 'https://example.com',
        'is_featured' => true,
        'sort_order' => 1,
        'is_active' => true,
    ];

    $this->post(route('admin.projects.store'), $data)
        ->assertRedirect(route('admin.projects.index'));

    $project = Project::where('slug', 'test-project')->first();

    expect($project)->not->toBeNull();
    expect($project->tags)->toBe(['React', 'Laravel']);
    expect($project->is_featured)->toBeTrue();
});

it('shows the edit form', function () {
    $project = Project::factory()->create();

    $this->get(route('admin.projects.edit', $project))
        ->assertSuccessful();
});

it('updates a project', function () {
    $project = Project::factory()->create();

    $this->put(route('admin.projects.update', $project), [
        'title' => 'Updated Project',
        'slug' => $project->slug,
        'category' => 'Mobile',
        'description' => 'Updated description.',
        'tags' => "Flutter\nDart",
        'project_url' => 'https://updated.com',
        'is_featured' => false,
        'sort_order' => 5,
        'is_active' => false,
    ])->assertRedirect(route('admin.projects.index'));

    $project->refresh();

    expect($project->title)->toBe('Updated Project');
    expect($project->is_featured)->toBeFalse();
});

it('deletes a project', function () {
    $project = Project::factory()->create();

    $this->delete(route('admin.projects.destroy', $project))
        ->assertRedirect(route('admin.projects.index'));

    expect(Project::find($project->id))->toBeNull();
});

it('validates required fields when storing', function () {
    $this->post(route('admin.projects.store'), [])
        ->assertSessionHasErrors(['title', 'slug', 'category', 'description', 'project_url', 'sort_order']);
});
