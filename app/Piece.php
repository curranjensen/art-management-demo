<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Piece extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'media_id',
        'name',
        'size',
        'month',
        'year',
        'number',
        'notes',
        'status',
        'licences'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'number';
    }

    /**
     * @return mixed
     */
    public function details()
    {
        return $this->hasMany(Detail::class)->orderBy('is_default', 'DESC');
    }

    /**
     * @return bool|string
     */
    public function month()
    {
        if( is_null($this->month)) return 'n/a';
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return substr($months[$this->month - 1], 0, 3) ;
    }

    /**
     * @return mixed|string
     */
    public function year()
    {
        return $this->year ?? 'n/a';
    }

    /**
     * @return mixed|string
     */
    public function size()
    {
        return $this->size ?? 'n/a';
    }

    /**
     * @return mixed|string
     */
    public function name()
    {
        return $this->name ?? 'Untitled';
    }

    /**
     * @return mixed|string
     */
    public function notes()
    {
        return $this->notes ? nl2br($this->notes) : 'n/a';
    }

    /**
     * @return mixed|string
     */
    public function licences()
    {
        return $this->licences ? nl2br($this->licences) : 'n/a';
    }

    /**
     * @return mixed|string
     */
    public function status()
    {
        return $this->status ?? 'n/a';
    }

    /**
     * @return mixed
     */
    public function thumbnail()
    {
        return $this->hasOne(Detail::class)->orderBy('is_default', 'DESC');
    }

    /**
     *
     */
    public function kill()
    {
        $this->details->each(function ($detail) {
           $detail->kill();
        });

        if( ! app()->environment('testing')) {
            Storage::deleteDirectory("public/details/{$this->number}");
        }

        $this->delete();
    }

    /**
     * @return mixed|string
     */
    public function completed()
    {
        if(! $this->month && ! $this->year) return 'n/a';
        if(! $this->month && $this->year) return $this->year;

        return $this->month() . ' / ' . $this->year();
    }
}
