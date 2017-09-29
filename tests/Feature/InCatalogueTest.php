<?php

namespace Tests\Feature;

use App\Detail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class InCatalogueTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_mark_a_detail_as_default()
    {
        $detail = factory(Detail::class)->create([
            'in_catalogue' => false
        ]);

        $response = $this->json('POST', "/details/{$detail->id}/in-catalogue");

        $response->assertStatus(200)
            ->assertJson([
                'in_catalogue' => true,
            ]);

        $updatedDetail = Detail::where([
            'id' => $detail->id,
            'in_catalogue' => true
        ])->first();

        $this->assertNotNull($updatedDetail);
    }

    /** @test */
    public function it_can_remove_a_detail_as_default()
    {
        $detail = factory(Detail::class)->create([
            'in_catalogue' => true
        ]);

        $response = $this->json('DELETE', "/details/{$detail->id}/in-catalogue");

        $response->assertStatus(200)
            ->assertJson([
                'in_catalogue' => false,
            ]);

        $updatedDetail = Detail::where([
            'id' => $detail->id,
            'in_catalogue' => false
        ])->first();

        $this->assertNotNull($updatedDetail);
    }
}
