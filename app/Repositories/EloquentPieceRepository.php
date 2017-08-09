<?php namespace App\Repositories;

use App\Piece;

class EloquentPieceRepository implements PieceRepository
{
    public function selectForIndex($sort, $medium)
    {
        return Piece::withCount('details')
            ->with('thumbnail')
            ->when($medium, function ($query) use ($medium) {
                return $query->where('media_id', $medium);
            })
            ->when($sort, function ($query) use ($sort) {
                return $query->orderBy($sort[0], $sort[1]);
            }, function ($query) {
                return $query->orderBy('number');
            })->paginate(25);
    }

    public function getNextPieceNumber()
    {
        return Piece::max('number') + 1;
    }

    public function create($attributes)
    {
        return Piece::create([
            'name' => $attributes['name'],
            'size' => $attributes['size'],
            'month' => $attributes['month'],
            'year' => $attributes['year'],
            'number' => $attributes['number'],
            'notes' => $attributes['notes'],
            'status' => $attributes['status'],
            'licences' => $attributes['licences'],
            'media_id' => $attributes['media_id'],
        ]);
    }

    public function getPrevious(Piece $piece)
    {
        return Piece::where('number', '<', $piece->number)
            ->orderBy('number', 'DESC')
            ->first();
    }

    public function getNext(Piece $piece)
    {
        return Piece::where('number', '>', $piece->number)
            ->orderBy('number')
            ->first();
    }

    public function kill(Piece $piece)
    {
        return $piece->kill();
    }

    public function update(Piece $piece, $attributes)
    {
        $piece->name = $attributes['name'];
        $piece->size = $attributes['size'];
        $piece->month = $attributes['month'];
        $piece->year = $attributes['year'];
        $piece->notes = $attributes['notes'];
        $piece->status = $attributes['status'];
        $piece->licences = $attributes['licences'];
        $piece->media_id = $attributes['media_id'];
        $piece->save();
    }

    public function getAllForExport()
    {
        return Piece::withCount('details')
            ->with('thumbnail')
            ->with('details')
            ->orderBy('number')
            ->get();
    }

    public function search($query)
    {
        return Piece::withCount('details')
            ->where('name', 'like', "%$query%")
            ->orWhere('number', '=', $query)
            ->orWhere('size', 'like', "%$query%")
            ->orWhere('notes', 'like', "%$query%")
            ->orWhere('status', 'like', "%$query%")
            ->orWhere('licences', 'like', "%$query%")
            ->orWhere('month', '=', $query)
            ->orWhere('year', '=', $query)
            ->paginate(25, ['*'], 'pieces');
    }
}