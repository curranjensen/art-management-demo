<?php

namespace Tests\Feature;

use App\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TagTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_shows_an_index_view()
    {
        $tag = factory(Tag::class)->create();

        $response = $this->get('/tags');

        $response->assertStatus(200);

        $response->assertSee($tag->name);
    }

    /** @test */
    public function a_user_can_display_a_single_tag()
    {
        $tag = factory(Tag::class)->create();

        $response = $this->get("/tags/{$tag->slug}");

        $response->assertStatus(200);

        $response->assertSee($tag->name);
    }
}