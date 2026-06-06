<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('projects')->get()->each(function ($project) {
            $decoded = json_decode((string) $project->description);
            if (! is_array($decoded)) {
                DB::table('projects')
                    ->where('id', $project->id)
                    ->update(['description' => json_encode([(string) $project->description])]);
            }
        });

        DB::statement('ALTER TABLE projects MODIFY description JSON');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE projects MODIFY description TEXT');
    }
};
