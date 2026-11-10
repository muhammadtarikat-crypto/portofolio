<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Skill;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\ProjectSkillSeeder;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class ProjectSkillRelationshipTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_database_seeder_connects_projects_and_skills_in_both_directions(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(ProjectSkillSeeder::class);

        $project = Project::where('title', 'Nusantara Journey')->firstOrFail();
        $flutter = Skill::where('name', 'Flutter')->firstOrFail();
        $figma = Skill::where('name', 'Figma')->firstOrFail();

        $this->assertDatabaseHas('project_skill', [
            'project_id' => $project->id,
            'skill_id' => $flutter->id,
        ]);
        $this->assertDatabaseHas('project_skill', [
            'project_id' => $project->id,
            'skill_id' => $figma->id,
        ]);

        $expectedSkillIds = [$flutter->id, $figma->id];
        sort($expectedSkillIds);

        $this->assertSame(
            $expectedSkillIds,
            $project->skills()->orderBy('skills.id')->pluck('skills.id')->all(),
        );
        $this->assertSame(
            [$project->id],
            $flutter->projects()->orderBy('projects.id')->pluck('projects.id')->all(),
        );
        $this->assertDatabaseHas('messages', ['email' => 'demo@example.test']);
        $this->assertDatabaseCount('project_skill', 7);
    }
}
