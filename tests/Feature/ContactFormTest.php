<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    /**
     * @return array{name: string, email: string, message: string}
     */
    private function validMessage(): array
    {
        return [
            'name' => 'Pengunjung',
            'email' => 'visitor@example.com',
            'message' => 'Saya ingin berdiskusi mengenai sebuah proyek web.',
        ];
    }

    public function test_contact_form_accepts_a_valid_message(): void
    {
        $response = $this->from('/')->post('/contact', $this->validMessage());

        $response->assertRedirect('/')
            ->assertSessionHas('success');
    }

    public function test_contact_form_rejects_invalid_input(): void
    {
        $response = $this->from('/')->post('/contact', [
            'name' => '',
            'email' => 'bukan-email',
            'message' => 'pendek',
        ]);

        $response->assertRedirect('/')
            ->assertSessionHasErrors(['name', 'email', 'message']);
    }

    public function test_contact_form_is_rate_limited(): void
    {
        for ($attempt = 0; $attempt < 6; $attempt++) {
            $this->post('/contact', $this->validMessage())->assertRedirect('/');
        }

        $this->post('/contact', $this->validMessage())->assertTooManyRequests();
    }

    public function test_contact_submission_does_not_log_personal_data(): void
    {
        Log::spy();

        $this->post('/contact', [
            'name' => 'Rahasia Pengunjung',
            'email' => 'rahasia@example.com',
            'message' => 'Pesan ini tidak boleh tersimpan di log aplikasi.',
        ]);

        Log::shouldHaveReceived('info')
            ->once()
            ->withArgs(function (string $message, array $context = []): bool {
                $logEntry = $message.json_encode($context);

                return ! str_contains($logEntry, 'rahasia@example.com')
                    && ! str_contains($logEntry, 'Pesan ini tidak boleh');
            });
    }
}
