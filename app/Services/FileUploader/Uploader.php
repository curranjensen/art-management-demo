<?php namespace App\Services\FileUploader;

use App\Piece;
use Illuminate\Http\UploadedFile;

abstract class Uploader
{
    /**
     * @var UploadedFile
     */
    protected $file;
    /**
     * @var Thumbnail
     */
    protected $thumbnail;
    /**
     * @var Piece
     */
    protected $piece;
    /**
     * @var RandomFileName
     */
    protected $fileNamer;

    /**
     * Uploader constructor.
     * @param Piece $piece
     * @param UploadedFile $file
     * @param RandomFileName $fileNamer
     * @param Thumbnail $thumbnail
     */
    public function __construct(Piece $piece, UploadedFile $file, RandomFileName $fileNamer = null, Thumbnail $thumbnail = null)
    {
        $this->piece = $piece;
        $this->file = $file;
        $this->fileNamer = $fileNamer ?: new RandomFileName();
        $this->thumbnail = $thumbnail ?: new Thumbnail();
    }

    abstract public function save();
}