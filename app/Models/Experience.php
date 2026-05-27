<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'type',
        'title',
        'subtitle',
        'start_date',
        'end_date',
        'description',
        'points',
        'tags',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'points' => 'array',
            'tags' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }
}
