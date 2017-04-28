<?php

namespace Tests\Feature;

use App\Piece;
use App\Detail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CropPieceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_shows_a_form_for_cropping()
    {
        $detail = factory(Detail::class)->create();

        $response = $this->get("/details/{$detail->id}/crop");

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_crop_an_image()
    {
        $piece = factory(Piece::class)->create();

        $detail = factory(Detail::class)->create([
            'piece_id' => $piece->id
        ]);

        $response = $this->post("/details/{$detail->id}/crop", [
            'colour' => '#FFFFFF',
            'size' => 12,
            'width' => 400,
            'height' => 300,
            'x' => 10,
            'y' => 10
        ]);

        $response->assertStatus(200);
    }
}