<?php

namespace Tests\Feature;

use App\Detail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteDetailTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_shows_a_form_for_deleting_a_detail()
    {
        $detail = factory(Detail::class)->create([]);

        $response = $this->get("/details/{$detail->id}/confirm-delete");

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_a_detail()
    {
        $detail = factory(Detail::class)->create([]);

        $response = $this->delete("/details/{$detail->id}");

        $response->assertStatus(302);

        $detail = Detail::find($detail->id);

        $this->assertNull($detail);
    }
}