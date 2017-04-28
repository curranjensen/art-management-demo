<?php namespace App\Services\FileUploader;

class FileObject
{
    private $originalWidth;
    private $originalHeight;

    /**
     * FileObject constructor.
     * @param $originalWidth
     * @param $originalHeight
     */
    public function __construct($originalWidth, $originalHeight)
    {
        $this->originalWidth = $originalWidth;
        $this->originalHeight = $originalHeight;
    }

    public function originalWidth()
    {
        return $this->originalWidth;
    }

    public function originalHeight()
    {
        return $this->originalHeight;
    }
}