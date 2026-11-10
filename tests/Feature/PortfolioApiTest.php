<?php

namespace Tests\Feature;

use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_profile_in_a_success_envelope(): void
    {
        Profile::create([
            'name' => 'Muhammad Tarikat',
            'headline' => 'Developer',
            'bio' => 'Portfolio profile',
            'photo' => 'images/profile.jpg',
            'email' => 'tarikat@example.com',
        ]);

        $response = $this->getJson('/api/portfolio/profile');

        $response->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('message', 'Data profil berhasil diambil.')
            ->assertJsonPath('data.name', 'Muhammad Tarikat')
            ->assertJsonPath('data.headline', 'Developer');
    }

    public function test_returns_a_json_404_when_profile_is_missing(): void
    {
        $response = $this->getJson('/api/portfolio/profile');

        $response->assertNotFound()
            ->assertJsonPath('status', 'error')
            ->assertJsonPath('data', null);
    }

    public function test_returns_skills_ordered_by_sort_in_a_success_envelope(): void
    {
        Skill::create(['name' => 'Laravel', 'category' => 'Backend', 'icon' => 'laravel.svg', 'sort' => 2]);
        Skill::create(['name' => 'HTML', 'category' => 'Frontend', 'icon' => 'html.svg', 'sort' => 1]);

        $response = $this->getJson('/api/portfolio/skills');

        $response->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('total', 2)
            ->assertJsonPath('data.0.name', 'HTML')
            ->assertJsonPath('data.1.name', 'Laravel')
            ->assertJsonPath('data.0.icon', 'html.svg');
    }

    public function test_returns_projects_in_sort_order_with_tags_and_slugs(): void
    {
        Project::create([
            'title' => 'Second Project',
            'slug' => 'second-project',
            'category' => 'web',
            'description' => 'Second description',
            'image' => 'images/second.svg',
            'tags' => ['Laravel'],
            'sort' => 2,
        ]);
        Project::create([
            'title' => 'First Project',
            'slug' => 'first-project',
            'category' => 'mobile',
            'description' => 'First description',
            'image' => 'images/first.svg',
            'tags' => ['Flutter', 'Figma'],
            'sort' => 1,
        ]);

        $response = $this->getJson('/api/portfolio/projects');

        $response->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('total', 2)
            ->assertJsonPath('data.0.slug', 'first-project')
            ->assertJsonPath('data.0.tags', ['Flutter', 'Figma'])
            ->assertJsonPath('data.1.title', 'Second Project');
    }

    public function test_returns_project_details_for_a_valid_slug(): void
    {
        Project::create([
            'title' => 'Nusantara Journey',
            'slug' => 'nusantara-journey',
            'category' => 'mobile',
            'description' => 'A travel application.',
            'image' => 'images/nusantara.svg',
            'tags' => ['Flutter'],
        ]);

        $response = $this->getJson('/api/portfolio/projects/nusantara-journey');

        $response->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('message', 'Detail proyek berhasil diambil.')
            ->assertJsonPath('data.slug', 'nusantara-journey')
            ->assertJsonPath('data.tags', ['Flutter']);
    }

    public function test_returns_a_json_404_for_an_unknown_project_slug(): void
    {
        $response = $this->getJson('/api/portfolio/projects/proyek-yang-tidak-ada');

        $response->assertNotFound()
            ->assertJsonPath('status', 'error')
            ->assertJsonPath('message', 'Data proyek tidak ditemukan.')
            ->assertJsonPath('data', null);
    }

    public function test_returns_experiences_in_a_success_envelope(): void
    {
        Experience::create([
            'type' => 'education',
            'title' => 'Informatics Student',
            'institution' => 'Universitas Teknokrat Indonesia',
            'period' => '2024 - Sekarang',
            'details' => ['Learning Laravel'],
            'sort' => 1,
        ]);

        $response = $this->getJson('/api/portfolio/experiences');

        $response->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('total', 1)
            ->assertJsonPath('data.0.title', 'Informatics Student')
            ->assertJsonPath('data.0.details', ['Learning Laravel']);
    }

    public function test_returns_certificates_in_a_success_envelope(): void
    {
        Certificate::create([
            'name' => 'Laravel Fundamentals',
            'issuer' => 'Laravel',
            'year' => '2026',
            'sort' => 1,
        ]);

        $response = $this->getJson('/api/portfolio/certificates');

        $response->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('total', 1)
            ->assertJsonPath('data.0.name', 'Laravel Fundamentals')
            ->assertJsonPath('data.0.issuer', 'Laravel');
    }

    public function test_home_page_shows_the_assignment_status_and_api_links(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('24312205')
            ->assertSee('/api/portfolio/profile')
            ->assertSee('/api/portfolio/certificates');
    }
}
