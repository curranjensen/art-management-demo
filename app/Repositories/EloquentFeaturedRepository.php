<?php namespace App\Repositories;

use App\Detail;

class EloquentFeaturedRepository implements FeaturedRepository
{
    public function selectForIndex($category = false)
    {
        return Detail::select('details.*')
                ->join('pieces', 'pieces.id', '=', 'details.piece_id')
                ->where('is_featured', true)
                ->when($category, function ($query) use ($category) {
                    return $query->where('category_id', $category);
                })
                ->orderBy('pieces.number')
                ->paginate(24);
    }
}