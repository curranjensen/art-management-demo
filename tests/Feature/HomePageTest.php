<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HomePageTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_visit_the_home_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_returns_a_random_photo()
    {
        $response = $this->json('GET', '/details/random');

        $response->assertStatus(200);
    }
}
