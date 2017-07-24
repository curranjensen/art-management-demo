<?php

namespace Tests\Unit;

use App\Detail;
use App\Piece;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PieceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_get_month()
    {
        $piece = factory(Piece::class)->make([
            'month' => 1
        ]);

        $this->assertEquals('Jan', $piece->month());
    }

    /** @test */
    public function can_get_year()
    {
        $piece = factory(Piece::class)->make([
            'year' => 2004
        ]);

        $this->assertEquals(2004, $piece->year());
    }

    /** @test */
    public function can_get_size()
    {
        $piece = factory(Piece::class)->make([
            'size' => '30 x 30'
        ]);

        $this->assertEquals('30 x 30', $piece->size());
    }

    /** @test */
    public function can_get_status()
    {
        $piece = factory(Piece::class)->make([
            'status' => 'in studio'
        ]);

        $this->assertEquals('in studio', $piece->status());
    }

    /** @test */
    public function can_get_licenses()
    {
        $piece = factory(Piece::class)->make([
            'licences' => 'in studio'
        ]);

        $this->assertEquals('in studio', $piece->licences());
    }

    /** @test */
    public function can_get_notes()
    {
        $piece = factory(Piece::class)->make([
            'notes' => 'first painting'
        ]);

        $this->assertEquals('first painting', $piece->notes());
    }

    /** @test */
    public function can_get_completed()
    {
        $piece = factory(Piece::class)->make([
            'month' => 1,
            'year' => 2004
        ]);

        $this->assertEquals('Jan / 2004', $piece->completed());

        $piece = factory(Piece::class)->make([
            'month' => null,
            'year' => null
        ]);

        $this->assertEquals('n/a', $piece->completed());

        $piece = factory(Piece::class)->make([
            'month' => null,
            'year' => 2004
        ]);

        $this->assertEquals(2004, $piece->completed());
    }

    /** @test */
    public function can_delete_itself_and_related_details()
    {
        $piece = factory(Piece::class)->create([
            'size' => '30 x 30'
        ]);

        $detail = factory(Detail::class)->create([
            'piece_id' => $piece->id
        ]);

        $piece->kill();

        $this->assertNull(Piece::where('size', '30 x 30')->first());
        $this->assertNull(Detail::where('piece_id', $piece->id)->first());
    }

}
