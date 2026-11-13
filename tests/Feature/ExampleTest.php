<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_portfolio_page_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Alexandros Saputra')
            ->assertSee('Portofolio');
    }

    public function test_contact_form_validates_and_accepts_a_message(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Pengunjung',
            'email' => 'visitor@example.com',
            'message' => 'Saya ingin berdiskusi mengenai sebuah proyek web.',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHas('success');
    }
}
