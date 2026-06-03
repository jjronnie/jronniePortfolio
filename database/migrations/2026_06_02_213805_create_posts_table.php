<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_category_id')
                ->nullable()
                ->constrained('post_categories')
                ->nullOnDelete();

            $table->string('title', 200);
            $table->string('slug', 220)->unique();
            $table->text('excerpt')->nullable();
            $table->longText('body');
            $table->string('featured_image', 500)->nullable();
            $table->string('featured_image_alt', 200)->nullable();

            $table->string('meta_title', 160)->nullable();
            $table->string('meta_description', 320)->nullable();
            $table->string('meta_keywords', 500)->nullable();
            $table->string('canonical_url', 500)->nullable();
            $table->string('og_title', 200)->nullable();
            $table->string('og_description', 500)->nullable();
            $table->string('og_image', 500)->nullable();
            $table->string('twitter_title', 200)->nullable();
            $table->string('twitter_description', 500)->nullable();
            $table->string('twitter_image', 500)->nullable();
            $table->enum('robots', [
                'index,follow',
                'noindex,follow',
                'index,nofollow',
                'noindex,nofollow',
            ])->default('index,follow');

            $table->string('schema_type', 50)->default('BlogPosting');
            $table->string('reading_time_minutes')->nullable();

            $table->enum('status', ['draft', 'published', 'scheduled', 'archived'])
                ->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamp('updated_content_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedBigInteger('view_count')->default(0);

            $table->decimal('sitemap_priority', 2, 1)->default(0.8);
            $table->enum('sitemap_changefreq', [
                'always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never',
            ])->default('monthly');
            $table->boolean('include_in_sitemap')->default(true);
            $table->boolean('include_in_feed')->default(true);

            $table->string('author_name', 100)->default('Jjuuko Ronald');
            $table->string('author_url', 500)->nullable();

            $table->timestamps();

            $table->index('status');
            $table->index('published_at');
            $table->index('is_featured');
            $table->index(['status', 'published_at']);
            $table->index('post_category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
