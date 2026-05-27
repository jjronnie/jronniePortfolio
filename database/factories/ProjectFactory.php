<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'slug' => fake()->unique()->slug(3),
            'category' => fake()->word(),
            'description' => fake()->paragraph(),
            'tags' => [fake()->word(), fake()->word(), fake()->word()],
            'project_url' => fake()->url(),
            'is_featured' => false,
            'sort_order' => fake()->numberBetween(1, 20),
            'is_active' => true,
        ];
    }
}
