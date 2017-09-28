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

        $width = 1024;
        $height = 768;
        $transparency = 0.7;
        $fontSize = 30;

        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->text($text,  (int) $width * (1/4), (int) $height/2, function ($font) use ($fontSize, $transparency) {
                $font->file(storage_path('font/segoepr.ttf'));
                $font->size($fontSize);
                $font->color([255, 255, 255, $transparency]);
                $font->align('center');
                $font->valign('center');
                $font->angle(45);
            })->text($text, (int) $width * (3/4), (int) $height/2, function ($font) use ($fontSize, $transparency) {
                $font->file(storage_path('font/segoepr.ttf'));
                $font->size($fontSize);
                $font->color([255, 255, 255, $transparency]);
                $font->align('center');
                $font->valign('center');
                $font->angle(45);
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