<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KnowledgeItem extends Model
{
    protected $fillable = [
        'category',
        'content',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCategory($query, string $category)
    {
        return $query->where('category', $category);
    }
}
