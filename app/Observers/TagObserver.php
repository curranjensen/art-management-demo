<?php namespace App\Observers;

use App\Tag;

class TagObserver
{
    public function creating(Tag $tag)
    {
        $tag->slug = str_slug($tag->name);
    }
}