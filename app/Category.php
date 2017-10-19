<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'type'
    ];

    public static function populate()
    {
        $types = [
            'earth',
            'angels',
            'celebration',
            'abstract',
        ];

        foreach ($types as $type) {
            static::firstOrCreate([
                'type' => $type
            ]);
        }
    }
}
