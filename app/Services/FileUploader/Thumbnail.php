<?php namespace App\Services\FileUploader;

use Image;

class Thumbnail
{
    public function make($src, $large, $thumbnail)
    {
        $image = Image::make($src);
        $width = $image->width();
        $height = $image->height();

        $image->fit(350, 200)
            ->save($large)
            ->fit(70, 50)
            ->save($thumbnail);

        return new FileObject($width, $height);
    }
}