<?php

namespace Tests\Feature;

use App\Piece;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EditPieceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_shows_a_form_for_editing_a_piece()
    {
        $piece = factory(Piece::class)->create([
            'number' => 1,
            'size' => '30 x 30',
            'name' => 'First Piece',
            'month' => 3,
            'year' => 2004
        ]);

        $response = $this->get("/pieces/{$piece->number}/edit");

        $response->assertStatus(200);
        $response->assertSee("$piece->number");
        $response->assertSee('30 x 30');
        $response->assertSee('First Piece');
        $response->assertSee('3');
        $response->assertSee('2004');
    }

    /** @test */
    public function it_can_update_a_piece()
    {
        $piece = factory(Piece::class)->create([
            'number' => 1,
            'name' => 'First Painting',
            'size' => '30 x 30',
            'month' => 1,
            'year' => 2004,
        ]);

        $response = $this->patch("/pieces/{$piece->number}", [
            'name' => 'Updated Name',
            'size' => '40 x 40',
            'month' => 2,
            'year' => 2005,
        ]);

        $response->assertStatus(302);

        $piece = Piece::where([
            'number' => 1,
            'name' => 'Updated Name',
            'size' => '40 x 40',
            'month' => 2,
            'year' => 2005,
        ])->first();

        $this->assertNotNull($piece);
    }
}