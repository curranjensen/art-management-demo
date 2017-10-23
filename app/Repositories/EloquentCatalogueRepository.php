<?php namespace App\Repositories;

use App\Detail;

class EloquentCatalogueRepository implements CatalogueRepository
{
    public function selectForIndex($category = false)
    {
        return Detail::select('details.*')
                ->join('pieces', 'pieces.id', '=', 'details.piece_id')
                ->where('in_catalogue', true)
                ->when($category, function ($query) use ($category) {
                    return $query->where('category_id', $category);
                })
                ->paginate(24);
    }
}