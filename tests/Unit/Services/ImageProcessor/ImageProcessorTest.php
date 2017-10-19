<?php

namespace Tests\Unit\Services\ImageProcessor;

use App\Detail;
use Mockery as m;
use Tests\TestCase;
use App\Services\ImageProcessor\ImageProcessor;
use App\Services\ImageProcessor\WatermarkedImage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ImageProcessorTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_crop_an_image()
    {
        $detail = factory(Detail::class)->create();

        $img = m::mock(WatermarkedImage::class);

        $img->shouldReceive('crop')
            ->once()
            ->with($detail, '#FFFFFF', 12, 400, 300, 0, 0);

        (new ImageProcessor($img))->cropForWatermark($detail, '#FFFFFF', 12, 400, 300, 0, 0);
    }

    /** @test */
    public function it_can_fit_an_image()
    {
        $detail = factory(Detail::class)->create();

        $img = m::mock(WatermarkedImage::class);

        $img->shouldReceive('fit')
            ->once()
            ->with($detail, '');

        (new ImageProcessor($img))->autoSaveWatermark($detail, '');
    }
}
