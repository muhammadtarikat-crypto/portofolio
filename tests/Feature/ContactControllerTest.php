<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_valid_contact_submission_is_saved_as_a_message_and_returns_201(): void
    {
        $response = $this->postJson('/api/contacts', [
            'name' => 'Pengunjung Demo',
            'email' => 'demo@example.test',
            'subject' => 'Pertanyaan portofolio',
            'message' => 'Saya ingin bertanya mengenai proyek Anda.',
        ]);

        $response->assertCreated()
            ->assertJson([
                'message' => 'Terima kasih! Pesan Anda sudah tersimpan.',
            ]);

        $this->assertDatabaseHas('messages', [
            'email' => 'demo@example.test',
            'subject' => 'Pertanyaan portofolio',
        ]);
    }

    public function test_missing_contact_fields_return_validation_errors_without_saving_a_message(): void
    {
        $response = $this->postJson('/api/contacts', []);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email', 'subject', 'message']);

        $this->assertDatabaseCount('messages', 0);
    }
}
