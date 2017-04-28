<?php

namespace Tests\Feature;

use App\Piece;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeletePieceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_shows_a_form_for_deleting_a_piece()
    {
        $piece = factory(Piece::class)->create([
            'number' => 1,
            'size' => '30 x 30',
            'name' => 'First Piece',
            'month' => 3,
            'year' => 2004
        ]);

        $response = $this->get("/pieces/{$piece->number}/confirm-delete");

        $response->assertStatus(200);
        $response->assertSee('First Piece');
    }

    /** @test */
    public function it_can_delete_a_piece()
    {
        $piece = factory(Piece::class)->create([
            'number' => 1,
            'name' => 'First Painting',
            'size' => '30 x 30',
            'month' => 1,
            'year' => 2004,
        ]);

        $response = $this->delete("/pieces/{$piece->number}");

        $response->assertStatus(302);

        $piece = Piece::where([
            'number' => 1,
            'name' => 'First Painting',
            'size' => '30 x 30',
            'month' => 1,
            'year' => 2004,
        ])->first();

        $this->assertNull($piece);
    }
}