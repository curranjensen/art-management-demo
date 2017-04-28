<?php

namespace Tests\Feature;

use App\Piece;
use App\Detail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewPiecesTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function it_shows_a_list_of_pieces()
    {
        $piece = factory(Piece::class)->create([
            'name' => 'First Piece',
            'month' => 1,
            'year' => 2004,
            'size' => '30 x 30'
        ]);

        $details = factory(Detail::class, 2)->create([
            'piece_id' => $piece->id,
        ]);

        $response = $this->get('/pieces');

        $response->assertStatus(200);
        $response->assertSee("$piece->number");
        $response->assertSee('2');
        $response->assertSee('30 x 30');
        $response->assertSee('First Piece');
        $response->assertSee('Jan');
        $response->assertSee('2004');
    }

    /** @test */
    public function it_shows_an_individual_piece()
    {
        $piece = factory(Piece::class)->create([
            'name' => 'First Piece',
            'month' => 1,
            'year' => 2004,
            'size' => '30 x 30'
        ]);

        $details = factory(Detail::class, 2)->create([
            'piece_id' => $piece->id,
        ]);

        $response = $this->get("/pieces/{$piece->number}");

        $response->assertStatus(200);
        $response->assertSee("$piece->number");
        $response->assertSee('2');
        $response->assertSee('30 x 30');
        $response->assertSee('First Piece');
        $response->assertSee('Jan');
        $response->assertSee('2004');
    }
}