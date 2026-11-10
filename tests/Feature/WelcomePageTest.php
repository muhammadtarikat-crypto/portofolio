<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class WelcomePageTest extends TestCase
{
    public function test_welcome_page_displays_identity_and_database_status(): void
    {
        $response = $this->get('/welcome');

        $response->assertOk()
            ->assertSee('Muhammad Tarikat')
            ->assertSee('24312205')
            ->assertSee('IF 24 Cx')
            ->assertSee('Laravel '.app()->version())
            ->assertSee('Tersambung');
    }

    public function test_welcome_page_reports_a_failed_database_connection(): void
    {
        DB::shouldReceive('connection')
            ->once()
            ->with(config('database.default'))
            ->andThrow(new \PDOException('Database unavailable.'));

        $response = $this->get('/welcome');

        $response->assertOk()
            ->assertSee('Tidak tersambung');
    }
}
