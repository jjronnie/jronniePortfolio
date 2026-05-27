<?php

use App\Models\Service;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('lists services', function () {
    Service::factory()->count(3)->create();

    $this->get(route('admin.services.index'))
        ->assertSuccessful();
});

it('shows the create form', function () {
    $this->get(route('admin.services.create'))
        ->assertSuccessful();
});

it('stores a service', function () {
    $data = [
        'title' => 'Test Service',
        'slug' => 'test-service',
        'description' => 'A test service description.',
        'icon_svg' => '<svg></svg>',
        'features' => "Feature 1\nFeature 2",
        'type' => 'core',
        'sort_order' => 1,
        'is_active' => true,
    ];

    $this->post(route('admin.services.store'), $data)
        ->assertRedirect(route('admin.services.index'));

    $service = Service::where('slug', 'test-service')->first();

    expect($service)->not->toBeNull();
    expect($service->features)->toBe(['Feature 1', 'Feature 2']);
});

it('shows the edit form', function () {
    $service = Service::factory()->create();

    $this->get(route('admin.services.edit', $service))
        ->assertSuccessful();
});

it('updates a service', function () {
    $service = Service::factory()->create();

    $this->put(route('admin.services.update', $service), [
        'title' => 'Updated Service',
        'slug' => $service->slug,
        'description' => 'Updated description.',
        'icon_svg' => '<svg></svg>',
        'features' => null,
        'type' => 'beyond',
        'sort_order' => 5,
        'is_active' => false,
    ])->assertRedirect(route('admin.services.index'));

    $service->refresh();

    expect($service->title)->toBe('Updated Service');
    expect($service->is_active)->toBeFalse();
    expect($service->features)->toBeNull();
});

it('deletes a service', function () {
    $service = Service::factory()->create();

    $this->delete(route('admin.services.destroy', $service))
        ->assertRedirect(route('admin.services.index'));

    expect(Service::find($service->id))->toBeNull();
});

it('validates required fields when storing', function () {
    $this->post(route('admin.services.store'), [])
        ->assertSessionHasErrors(['title', 'slug', 'description', 'icon_svg', 'type', 'sort_order']);
});
