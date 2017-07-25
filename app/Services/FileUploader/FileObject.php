<?php namespace App\Services\FileUploader;

class FileObject
{
    private $originalWidth;
    private $originalHeight;
    private $filesize;

    /**
     * FileObject constructor.
     * @param $originalWidth
     * @param $originalHeight
     */
    public function __construct($originalWidth, $originalHeight, $filesize)
    {
        $this->originalWidth = $originalWidth;
        $this->originalHeight = $originalHeight;
        $this->filesize = $filesize;
    }

    public function originalWidth()
    {
        return $this->originalWidth;
    }

    public function originalHeight()
    {
        return $this->originalHeight;
    }

    public function filesize()
    {
        return $this->filesize;
    }
}