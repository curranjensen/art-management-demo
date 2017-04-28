<?php namespace App\Services\ImageProcessor;

use App\Detail;

class ImageProcessor
{
    /**
     * @var WatermarkedImage
     */
    protected $image;

    /**
     * ImageProcessor constructor.
     * @param WatermarkedImage $image
     */
    public function __construct(WatermarkedImage $image)
    {
        $this->image = $image ?: new WatermarkedImage();
    }

    public function autoSaveWatermark(Detail $detail)
    {
        $this->image->fit($detail);
    }

    public function cropForWatermark(Detail $detail, $colour, $size, $width, $height, $x, $y)
    {
        $this->image->crop($detail, $colour, $size, $width, $height, $x, $y);
    }
}