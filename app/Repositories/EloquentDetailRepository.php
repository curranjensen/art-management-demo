<?php namespace App\Repositories;

use App\Detail;
use App\Piece;

class EloquentDetailRepository implements DetailRepository
{
    public function selectForIndex($sort = false)
    {
        return Detail::select('details.*')
            ->join('pieces', 'pieces.id', '=', 'details.piece_id')
            ->when($sort, function ($query) use ($sort) {
                return $query->orderBy($sort[0], $sort[1]);
            }, function ($query) {
                return $query->orderBy('pieces.number');
            })->paginate(24);
    }

    public function getPrevious(Piece $piece, Detail $detail)
    {
        return $piece->details()
            ->where('id', '<', $detail->id)
            ->orderBy('id', 'DESC')
            ->first();
    }

    public function getNext(Piece $piece, Detail $detail)
    {
        return $piece->details()
            ->where('id', '>', $detail->id)
            ->orderBy('id')
            ->first();
    }

    public function kill(Detail $detail)
    {
        return $detail->kill();
    }

    public function makeDefault(Detail $detail)
    {
        $detail->piece->details()->update(['is_default' => false]);
        $detail->is_default = true;
        $detail->save();
    }

    public function removeDefault(Detail $detail)
    {
        $detail->piece->details()->update(['is_default' => false]);
    }

    public function getAllForExport()
    {
        return Detail::select('details.*')
            ->join('pieces', 'pieces.id', '=', 'details.piece_id')
            ->orderBy('pieces.number')
            ->get();
    }

    public function getRandomDetail()
    {
       return Detail::inRandomOrder()->first();
    }

    public function search($query)
    {
        return Detail::where('id', '=', $query)
            ->orWhere('file_name', 'like', "%$query%")
            ->orWhere('original_file_name', 'like', "%$query%")
            ->orWhere('width', '=', $query)
            ->orWhere('height', '=', $query)
            ->paginate(25, ['*'], 'details');
    }

    public function all()
    {
        return Detail::all();
    }
}