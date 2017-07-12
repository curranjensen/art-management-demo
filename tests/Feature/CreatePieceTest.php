<?php

namespace Tests\Feature;

use App\Piece;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreatePieceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_shows_a_form_for_creating_a_piece()
    {
        $response = $this->get('/pieces/create');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_create_a_new_piece()
    {

        $this->disableExceptionHandling();
        $response = $this->post('/pieces', [
            'media_id' => 1,
            'name' => 'First Painting',
            'size' => '30 x 30',
            'month' => 1,
            'year' => 2004,
            'number' => 1,
            'notes' => 'A note',
            'status' => 'A status',
            'licences' => 'A licence'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('pieces.edit', 1));

        $piece = Piece::where([
            'media_id' => 1,
            'name' => 'First Painting',
            'size' => '30 x 30',
            'month' => 1,
            'year' => 2004,
            'number' => 1,
            'notes' => 'A note',
            'status' => 'A status',
            'licences' => 'A licence'
        ])->first();

        $this->assertNotNull($piece);
    }
}