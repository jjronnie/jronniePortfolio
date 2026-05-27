<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'slug' => fake()->unique()->slug(3),
            'description' => fake()->paragraph(),
            'icon_svg' => '<svg></svg>',
            'features' => [fake()->word(), fake()->word(), fake()->word()],
            'type' => fake()->randomElement(['core', 'beyond']),
            'sort_order' => fake()->numberBetween(1, 20),
            'is_active' => true,
        ];
    }
}
