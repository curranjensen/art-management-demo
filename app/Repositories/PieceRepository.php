<?php namespace App\Repositories;

use App\Piece;

interface PieceRepository
{
    public function selectForIndex($sort);

    public function getNextPieceNumber();

    public function create($attributes);

    public function getPrevious(Piece $piece);

    public function getNext(Piece $piece);

    public function kill(Piece $piece);

    public function update(Piece $piece, $attributes);

    public function getAllForExport();

    public function search($query);
}