<?php namespace App\Services\FileUploader;

class RandomFileName
{
    public function makeFileName($extension)
    {
        $name = str_random(7);

        $extension = strtolower($extension);

        return "{$name}.{$extension}";
    }
}