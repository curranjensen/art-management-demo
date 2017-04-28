<?php namespace Tests\Unit;

use App\Detail;
use App\Piece;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DetailTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_get_thumbnail_attribute()
    {
        $piece = factory(Piece::class)->create([
            'number' => 1
        ]);

        $detail = factory(Detail::class)->create([
            'piece_id' => $piece->id
        ]);

        $this->assertEquals(asset('/storage/details/1/th_saved_file.jpg'), $detail->thumbnail);
    }

    /** @test */
    public function can_get_large_attribute()
    {
        $piece = factory(Piece::class)->create([
            'number' => 1
        ]);

        $detail = factory(Detail::class)->create([
            'piece_id' => $piece->id
        ]);

        $this->assertEquals(asset('/storage/details/1/lg_saved_file.jpg'), $detail->large);
    }

    /** @test */
    public function can_get_original_attribute()
    {
        $piece = factory(Piece::class)->create([
            'number' => 1
        ]);

        $detail = factory(Detail::class)->create([
            'piece_id' => $piece->id
        ]);

        $this->assertEquals(asset('/storage/details/1/saved_file.jpg'), $detail->original);
    }

    /** @test */
    public function can_get_original_path_attribute()
    {
        $piece = factory(Piece::class)->create([
            'number' => 1
        ]);

        $detail = factory(Detail::class)->create([
            'piece_id' => $piece->id
        ]);

        $this->assertEquals(storage_path('app/public/details/1/saved_file.jpg'), $detail->originalPath);
    }

    /** @test */
    public function can_get_watermarked_path_attribute()
    {
        $detail = factory(Detail::class)->create();

        $this->assertEquals(storage_path('app/public/watermarked/saved_file.jpg'), $detail->watermarkedPath);
    }


    /** @test */
    public function can_get_exif_attribute()
    {
        $detail = factory(Detail::class)->make();

        $this->assertEquals('', $detail->exif);
    }

    /** @test */
    public function can_get_is_default()
    {
        $detail = factory(Detail::class)->make([
            'is_default' => true
        ]);

        $this->assertEquals('true', $detail->isDefault());

        $detail = factory(Detail::class)->make([
            'is_default' => false
        ]);

        $this->assertEquals('false', $detail->isDefault());
    }

    /** @test */
    public function can_delete_itself_and_images()
    {
        $piece = factory(Piece::class)->create([
            'number' => 1
        ]);

        $detail = factory(Detail::class)->create([
            'piece_id' => $piece->id
        ]);

        $detail->kill();

    }
}