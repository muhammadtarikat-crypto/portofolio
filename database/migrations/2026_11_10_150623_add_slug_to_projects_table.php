<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique();
        });

        DB::table('projects')->orderBy('id')->get(['id', 'title'])->each(function (object $project): void {
            $baseSlug = Str::slug($project->title) ?: 'project';
            $slug = $baseSlug;
            $suffix = 1;

            while (DB::table('projects')->where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$project->id}-{$suffix}";
                $suffix++;
            }

            DB::table('projects')->where('id', $project->id)->update(['slug' => $slug]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
