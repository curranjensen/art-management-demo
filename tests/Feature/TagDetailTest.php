<?php

namespace Tests\Feature;

use App\Tag;
use App\Detail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TagDetailTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_detail_can_be_tagged()
    {
        $detail = factory(Detail::class)->create();

        $tag = Tag::create([
            'name' => 'Christmas',
            'slug' => 'christmas'
        ]);

        $detail->tags()->attach($tag);

        $this->assertContains('Christmas', $detail->tags->pluck('name'));
        $this->assertContains('christmas', $detail->tags->pluck('slug'));
    }

    /** @test */
    public function a_user_can_tag_a_detail_and_also_remove_tags()
    {
        $this->disableExceptionHandling();
        $detail = factory(Detail::class)->create();

        $response = $this->patchJson("details/{$detail->id}/tags", [
            'tags' => ['one', 'two', 'three']
        ]);

        $response->assertStatus(200);

        $this->assertCount(3, $detail->fresh()->tags);

        $response = $this->patchJson("details/{$detail->id}/tags", [
            'tags' => []
        ]);

        $response->assertStatus(200);

        $this->assertCount(0, $detail->fresh()->tags);
    }
}