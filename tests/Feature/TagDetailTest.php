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
}