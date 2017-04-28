<?php namespace App\Services\ImageProcessor;

use Image;
use App\Detail;

class WatermarkedImage
{
    public function crop(Detail $detail, $colour, $size, $width, $height, $x, $y)
    {
        try {
            $img = Image::make($detail->originalPath);
        } catch (\Exception $e) {
            return;
        }

        $text = $this->getWatermarkText($detail);

        $img->crop($width, $height, $x, $y)
            ->resize(400, 300)
            ->text($text, 5, 295, function ($font) use ($size, $colour) {
                $font->file(storage_path('font/segoepr.ttf'));
                $font->size($size);
                $font->color($colour);
            })->save($detail->watermarkedPath);
    }

    public function fit(Detail $detail)
    {
        try {
            $img = Image::make($detail->originalPath);
        } catch (\Exception $e) {
            return;
        }

        $text = $this->getWatermarkText($detail);

        $fileName = sprintf('%s%s-%s_%s',
            storage_path('app/public/watermarked-batch/'),
            $detail->piece->number,
            str_slug($detail->piece->name()),
            $detail->file_name);

        $img->fit(400, 300)
            ->text($text, 5, 295, function ($font) {
                $font->file(storage_path('font/segoepr.ttf'));
                $font->size(12);
                $font->color('#FFFFFF');
            })->save($fileName);
    }

    /**
     * @param Detail $detail
     * @return string
     */
    private function getWatermarkText(Detail $detail): string
    {
        return ($detail->piece->name ?: 'Untitled') . ' © ' . config('owner.name');
    }
}