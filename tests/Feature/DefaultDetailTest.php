<?php

namespace Tests\Feature;

use App\Detail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DefaultDetailTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_mark_a_detail_as_default()
    {
        $detail = factory(Detail::class)->create([
            'is_default' => false
        ]);

        $response = $this->json('POST', "/details/{$detail->id}/default");

        $response->assertStatus(200)
            ->assertJson([
                'is_default' => true,
            ]);

        $updatedDetail = Detail::where([
            'id' => $detail->id,
            'is_default' => true
        ])->first();

        $this->assertNotNull($updatedDetail);
    }

    /** @test */
    public function it_can_remove_a_detail_as_default()
    {
        $detail = factory(Detail::class)->create([
            'is_default' => true
        ]);

        $response = $this->json('DELETE', "/details/{$detail->id}/default");

        $response->assertStatus(200)
            ->assertJson([
                'is_default' => false,
            ]);

        $updatedDetail = Detail::where([
            'id' => $detail->id,
            'is_default' => false
        ])->first();

        $this->assertNotNull($updatedDetail);
    }
}
