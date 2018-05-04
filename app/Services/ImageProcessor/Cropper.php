<?php namespace App\Services\ImageProcessor;

use Image;
use App\Detail;

class Cropper
{
    public function crop(Detail $detail, $width, $height, $x, $y)
    {
        try {
            $img = Image::make($detail->originalPath);
        } catch (\Exception $e) {
            return;
        }

        $img->crop($width, $height, $x, $y)
            ->save($detail->originalPath)
            ->fit(350, 350)
            ->save($detail->absoluteLarge)
            ->fit(70, 50)
            ->save($detail->absoluteThumbnail);
    }
}