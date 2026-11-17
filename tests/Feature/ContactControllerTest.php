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

    public function test_valid_portfolio_message_submission_returns_201_and_does_not_allow_read_status_mass_assignment(): void
    {
        $response = $this->postJson('/api/portfolio/messages', [
            'sender_name' => '<b>Pengunjung Portofolio</b>',
            'sender_email' => 'portfolio@example.test',
            'subject' => 'Tawaran kerja',
            'body' => '<script>alert(1)</script>Saya ingin berdiskusi tentang proyek yang Anda buat sebelumnya.',
            'is_read' => true,
        ]);

        $response->assertCreated()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('data.sender_name', 'Pengunjung Portofolio')
            ->assertJsonPath('data.sender_email', 'portfolio@example.test')
            ->assertJsonPath('data.body', 'alert(1)Saya ingin berdiskusi tentang proyek yang Anda buat sebelumnya.');

        $this->assertDatabaseHas('messages', [
            'name' => 'Pengunjung Portofolio',
            'email' => 'portfolio@example.test',
            'subject' => 'Tawaran kerja',
            'is_read' => false,
        ]);
    }

    public function test_missing_contact_fields_return_validation_errors_without_saving_a_message(): void
    {
        $response = $this->postJson('/api/contacts', []);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email', 'subject', 'message']);

        $this->assertDatabaseCount('messages', 0);
    }

    public function test_missing_portfolio_message_fields_return_validation_errors_without_saving_a_message(): void
    {
        $response = $this->postJson('/api/portfolio/messages', []);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['sender_name', 'sender_email', 'subject', 'body'])
            ->assertJsonPath('errors.sender_name.0', 'Nama pengirim wajib diisi.')
            ->assertJsonPath('errors.body.0', 'Isi pesan wajib diisi.');

        $this->assertDatabaseCount('messages', 0);
    }

    public function test_invalid_portfolio_message_email_and_short_body_return_custom_validation_errors(): void
    {
        $response = $this->postJson('/api/portfolio/messages', [
            'sender_name' => 'Pengunjung Demo',
            'sender_email' => 'not-an-email',
            'subject' => 'Pertanyaan',
            'body' => 'pendek',
        ]);

        $response->assertUnprocessable()
            ->assertJsonPath('errors.sender_email.0', 'Format alamat email tidak valid.')
            ->assertJsonPath('errors.body.0', 'Isi pesan terlalu pendek, minimal 10 karakter agar maksud pesan jelas.');

        $this->assertDatabaseCount('messages', 0);
    }

    public function test_portfolio_message_endpoint_is_rate_limited_to_five_requests_per_minute(): void
    {
        $payload = [
            'sender_name' => 'Pengunjung Demo',
            'sender_email' => 'demo@example.test',
            'subject' => 'Pertanyaan',
            'body' => 'Saya ingin bertanya mengenai portofolio Anda.',
        ];

        for ($request = 0; $request < 5; $request++) {
            $this->postJson('/api/portfolio/messages', $payload)->assertCreated();
        }

        $this->postJson('/api/portfolio/messages', $payload)->assertTooManyRequests();
    }
}
