<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
    protected $fillable = [
        'type'
    ];

    public static function populate()
    {
        $types = [
            'painting on silk',
            'pen and ink drawing',
            'studio photo',
            'exhibition photo',
        ];

        foreach($types as $type)
        {
            static::firstOrCreate([
                'type' => $type
            ]);
        }
    }
}
