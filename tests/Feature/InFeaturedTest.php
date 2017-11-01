<?php

namespace Tests\Feature;

use App\Detail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class InFeaturedTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_mark_a_detail_as_default()
    {
        $detail = factory(Detail::class)->create([
            'is_featured' => false
        ]);

        $response = $this->json('POST', "/details/{$detail->id}/is-featured");

        $response->assertStatus(200)
            ->assertJson([
                'is_featured' => true,
            ]);

        $updatedDetail = Detail::where([
            'id' => $detail->id,
            'is_featured' => true
        ])->first();

        $this->assertNotNull($updatedDetail);
    }

    /** @test */
    public function it_can_remove_a_detail_as_default()
    {
        $detail = factory(Detail::class)->create([
            'is_featured' => true
        ]);

        $response = $this->json('DELETE', "/details/{$detail->id}/is-featured");

        $response->assertStatus(200)
            ->assertJson([
                'is_featured' => false,
            ]);

        $updatedDetail = Detail::where([
            'id' => $detail->id,
            'is_featured' => false
        ])->first();

        $this->assertNotNull($updatedDetail);
    }
}