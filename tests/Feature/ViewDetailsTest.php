<?php

namespace Tests\Feature;

use App\Piece;
use App\Detail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewDetailsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_shows_a_list_of_details()
    {
        $piece = factory(Piece::class)->create([
            'name' => 'First Piece',
            'month' => 1,
            'year' => 2004
        ]);

        $detail = factory(Detail::class)->create([
            'piece_id' => $piece->id,
            'file_name' => 'saved_file.jpg',
            'width' => 800,
            'height' => 600
        ]);

        $response = $this->get('/details');

        $response->assertStatus(200);
        $response->assertSee("$piece->number");
        $response->assertSee('First Piece');
        $response->assertSee($piece->number . '/saved_file.jpg');
        $response->assertSee('800');
        $response->assertSee('600');
        $response->assertSee('Jan');
        $response->assertSee('2004');
    }

    /** @test */
    public function it_shows_an_individual_detail()
    {
        $piece = factory(Piece::class)->create([
            'name' => 'First Piece',
            'month' => 1,
            'year' => 2004
        ]);

        $detail = factory(Detail::class)->create([
            'piece_id' => $piece->id,
            'file_name' => 'saved_file.jpg',
            'width' => 800,
            'height' => 600
        ]);

        $response = $this->get("/details/{$detail->id}");

        $response->assertStatus(200);
        $response->assertSee("$piece->number");
        $response->assertSee('First Piece');
        $response->assertSee($piece->number . '/saved_file.jpg');
        $response->assertSee('800');
        $response->assertSee('600');
        $response->assertSee('Jan');
        $response->assertSee('2004');
    }
}