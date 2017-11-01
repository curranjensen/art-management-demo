<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Detail extends Model
{
    public $guarded = [];

    public $with = ['piece'];

    protected $appends = ['thumbnail', 'large', 'original'];

    protected $casts = [
        'is_default' => 'boolean',
        'in_catalogue' => 'boolean',
        'is_featured' => 'boolean'
    ];

    public function piece()
    {
        return $this->belongsTo(Piece::class);
    }

    public function getThumbnailAttribute()
    {
        return asset("storage/details/{$this->piece->number}/th_{$this->file_name}");
    }

    public function getAbsoluteThumbnailAttribute()
    {
        return storage_path("app/public/details/{$this->piece->number}/th_{$this->file_name}");
    }

    public function getExifAttribute()
    {
        return '';
    }

    public function getLargeAttribute()
    {
        return asset("storage/details/{$this->piece->number}/lg_{$this->file_name}");
    }

    public function getAbsoluteLargeAttribute()
    {
        return storage_path("app/public/details/{$this->piece->number}/lg_{$this->file_name}");
    }

    public function getOriginalAttribute()
    {
        return asset("storage/details/{$this->piece->number}/{$this->file_name}");
    }

    public function getOriginalPathAttribute()
    {
        return storage_path("app/public/details/{$this->piece->number}/{$this->file_name}");
    }

    public function getWatermarkedPathAttribute()
    {
        return storage_path("app/public/watermarked/{$this->file_name}");
    }

    public function kill()
    {
        $this->tags()->detach();

        if( ! app()->environment('testing')) {
            if (Storage::exists("public/details/{$this->piece->number}/th_{$this->file_name}")) {
                Storage::delete("public/details/{$this->piece->number}/th_{$this->file_name}");
            }

            if (Storage::exists("public/details/{$this->piece->number}/lg_{$this->file_name}")) {
                Storage::delete("public/details/{$this->piece->number}/lg_{$this->file_name}");
            }

            if (Storage::exists("public/details/{$this->piece->number}/{$this->file_name}")) {
                Storage::delete("public/details/{$this->piece->number}/{$this->file_name}");
            }
        }

        $this->delete();
    }

    public function isDefault()
    {
        return $this->is_default;
    }

    public function inCatalogue()
    {
        return $this->in_catalogue;
    }

    public function isFeatured()
    {
        return $this->is_featured;
    }

    public function filesize()
    {
        return number_format($this->filesize / 1024 / 1024, 3);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}