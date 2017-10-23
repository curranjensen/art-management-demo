<?php namespace App\Repositories;

use App\Detail;

class EloquentCatalogueRepository implements CatalogueRepository
{
    public function selectForIndex()
    {
        return Detail::select('details.*')
                ->join('pieces', 'pieces.id', '=', 'details.piece_id')
                ->where('in_catalogue', true)
                ->paginate(24);
    }
}