<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class ProjectSkillSeeder extends Seeder
{
    public function run(): void
    {
        $projectSkills = [
            'Nusantara Journey' => ['Flutter', 'Figma'],
            'EcoHero' => ['Figma'],
            'CleanCity' => ['Figma'],
            'Website Portofolio' => ['Laravel', 'Tailwind CSS', 'MySQL'],
        ];

        foreach ($projectSkills as $projectTitle => $skillNames) {
            $project = Project::where('title', $projectTitle)->firstOrFail();
            $skillIds = Skill::whereIn('name', $skillNames)->pluck('id');

            if ($skillIds->count() !== count($skillNames)) {
                throw new \RuntimeException("One or more skills are missing for project {$projectTitle}.");
            }

            $project->skills()->syncWithoutDetaching($skillIds->all());
        }
    }
}
