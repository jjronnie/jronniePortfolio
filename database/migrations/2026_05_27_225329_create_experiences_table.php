<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'work' or 'education'
            $table->string('title');
            $table->string('subtitle'); // company or institution
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->text('description')->nullable();
            $table->json('points')->nullable();
            $table->json('tags')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
