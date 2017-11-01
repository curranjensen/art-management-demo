<?php namespace App\Repositories;

use App\Detail;
use App\Piece;

interface DetailRepository
{
    public function selectForIndex($sort = false);

    public function getPrevious(Piece $piece, Detail $detail);

    public function getNext(Piece $piece, Detail $detail);

    public function kill(Detail $detail);

    public function makeDefault(Detail $detail);

    public function removeDefault(Detail $detail);

    public function getAllForExport();

    public function getRandomDetail();

    public function search($query);

    public function all();

    public function addToCatalogue(Detail $detail);

    public function removeFromCatalogue(Detail $detail);

    public function addToFeatured(Detail $detail);

    public function removeFromFeatured(Detail $detail);
}