<?php namespace App\Services\FileUploader;

use App\Detail;
use Storage;

class PhotoUploader extends Uploader
{

    public function save()
    {
        $file_name = $this->fileNamer->makeFileName($this->file->getClientOriginalExtension());

        $exif = $this->getExif();

        $this->file->move(storage_path("app/public/details/{$this->piece->number}"), $file_name);

        $fileObject = $this->thumbnail->make(storage_path("app/public/details/{$this->piece->number}/{$file_name}"),
            storage_path("app/public/details/{$this->piece->number}/lg_{$file_name}"),
            storage_path("app/public/details/{$this->piece->number}/th_{$file_name}"));

        return $this->piece->details()->save($this->newDetail($fileObject, $file_name, $exif));
    }

    private function newDetail(FileObject $fileObject, $file_name, $exif)
    {
        return new Detail([
            'piece_id' => $this->piece->id,
            'file_name' => $file_name,
            'width' => $fileObject->originalWidth(),
            'height' => $fileObject->originalHeight(),
            'filesize' => $fileObject->filesize(),
            'original_file_name' => $this->file->getClientOriginalName(),
            'exif' => $exif
        ]);
    }

    /**
     * @return array|null|string
     */
    private function getExif()
    {
        try {
            $exif = exif_read_data($this->file);
        } catch (\Exception $e) {
            $exif = null;
       }

        return $exif ? json_encode($exif) : null;
    }
}