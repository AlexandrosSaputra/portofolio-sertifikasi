<?php

namespace Tests\Feature;

use Tests\TestCase;

class PortfolioPageTest extends TestCase
{
    public function test_portfolio_page_renders_all_main_sections(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Alexandros Saputra')
            ->assertSee('id="home"', false)
            ->assertSee('id="about"', false)
            ->assertSee('id="skills"', false)
            ->assertSee('id="projects"', false)
            ->assertSee('id="contact"', false);
    }

    public function test_portfolio_page_renders_navigation_links(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('data-menu-button', false)
            ->assertSee('aria-controls="mobile-menu"', false);

        foreach (['Beranda', 'Tentang', 'Keahlian', 'Proyek', 'Kontak'] as $label) {
            $response->assertSee($label);
        }
    }

    public function test_portfolio_page_renders_project_showcase(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Pandansari System')
            ->assertSee('NH-ZIS')
            ->assertSee('Absensi Pegawai')
            ->assertSee('SIM Pegawai')
            ->assertSee('Penggajian Pegawai')
            ->assertSee('Pengadaan Barang')
            ->assertSee('data-project-showcase', false)
            ->assertSee('data-project-title', false)
            ->assertSee('data-project-previous', false)
            ->assertSee('data-project-next', false);

        $this->assertSame(6, substr_count((string) $response->getContent(), 'data-project-card'));
    }

    public function test_portfolio_page_renders_contact_channels(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('https://www.linkedin.com/in/alexandrossaputra/', false)
            ->assertSee('https://www.instagram.com/alexandrossaputra/', false)
            ->assertSee('mailto:alexandrossaputra@gmail.com', false)
            ->assertSee('https://github.com/alexandrossaputra', false)
            ->assertSee('@alexandrossaputra')
            ->assertSee('alexandrossaputra@gmail.com')
            ->assertSee('Surabaya, Indonesia')
            ->assertSee('contact-flight-route', false)
            ->assertSee('contact-flight-plane', false);
    }

    public function test_portfolio_page_renders_about_skill_tabs(): void
    {
        $response = $this->get('/');

        $response->assertSee('Web Developer')
            ->assertSee('Machine Learning')
            ->assertSee('skill-tab-ui-ux', false)
            ->assertSee('skill-panel-ui-ux', false);
    }

    public function test_portfolio_page_renders_skill_domains_with_details(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('CAPABILITIES.LOG')
            ->assertSee('Fokus utama')
            ->assertSee('Web Developer')
            ->assertSee('Android Developer')
            ->assertSee('Data Analyst')
            ->assertSee('Machine Learning')
            ->assertSee('Kriptografi')
            ->assertSee('Flutter')
            ->assertSee('Supabase')
            ->assertSee('Ollama')
            ->assertSee('MLPClassifier')
            ->assertSee('Prediction Error');
    }

    public function test_skill_section_reuses_the_same_domains_as_the_about_section(): void
    {
        $response = $this->get('/');
        $domains = ['web-developer', 'android-developer', 'data-analyst', 'machine-learning', 'kriptografi', 'ui-ux'];

        foreach ($domains as $domain) {
            $response->assertSee('skill-tab-'.$domain, false)
                ->assertSee('data-skill-domain="'.$domain.'"', false);
        }

        $this->assertSame(count($domains), substr_count((string) $response->getContent(), 'data-skill-domain="'));
    }
}
