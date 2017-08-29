<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $guarded = [];

    public function details()
    {
        return $this->belongsToMany(Detail::class);
    }
}
