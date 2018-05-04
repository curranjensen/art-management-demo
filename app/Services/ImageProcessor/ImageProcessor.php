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

    public function autoSaveWatermark(Detail $detail, $path)
    {
        $this->image->fit($detail, $path);
    }

    public function exportForFeatured(Detail $detail, $path = null, $fileName = null)
    {
        $this->image->fit($detail, $path, $fileName);
    }

    public function cropForWatermark(Detail $detail, $colour, $size, $width, $height, $x, $y)
    {
        $this->image->crop($detail, $colour, $size, $width, $height, $x, $y);
    }
}