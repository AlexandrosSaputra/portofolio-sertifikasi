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

        foreach (['Beranda', 'Tentang', 'Keahlian', 'Proyek', 'Kontak'] as $label) {
            $response->assertSee($label);
        }
    }

    public function test_portfolio_page_renders_projects_and_filters(): void
    {
        $response = $this->get('/');

        $response->assertSee('Absensi Pegawai')
            ->assertSee('SIM Pegawai')
            ->assertSee('Penggajian Pegawai')
            ->assertSee('Pengadaan Barang')
            ->assertSee('data-filter="web"', false)
            ->assertSee('data-filter="frontend"', false)
            ->assertSee('data-filter="design"', false);
    }

    public function test_portfolio_page_renders_about_skill_tabs(): void
    {
        $response = $this->get('/');

        $response->assertSee('Web Developer')
            ->assertSee('Machine Learning')
            ->assertSee('skill-tab-ui-ux', false)
            ->assertSee('skill-panel-ui-ux', false);
    }

    public function test_portfolio_page_renders_skills_console(): void
    {
        $response = $this->get('/');

        $response->assertSee('CAPABILITIES.LOG')
            ->assertSee('Frontend')
            ->assertSee('Backend')
            ->assertSee('Programming')
            ->assertSee('Design');
    }
}
