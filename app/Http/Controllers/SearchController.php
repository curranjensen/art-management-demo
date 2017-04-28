<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Repositories\DetailRepository;
use App\Repositories\PieceRepository;

class SearchController extends Controller
{
    /**
     * @var PieceRepository
     */
    protected $pieceRepository;
    /**
     * @var DetailRepository
     */
    protected $detailRepository;

    /**
     * SearchController constructor.
     * @param PieceRepository $pieceRepository
     * @param DetailRepository $detailRepository
     */
    public function __construct(PieceRepository $pieceRepository, DetailRepository $detailRepository)
    {
        $this->pieceRepository = $pieceRepository;
        $this->detailRepository = $detailRepository;
    }

    /**
     * Searches for pieces and details
     *
     * @param SearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(SearchRequest $request)
    {
        $query = $request->get('q');

        $pieces = $this->pieceRepository->search($query);
        $details = $this->detailRepository->search($query);

        return view('search.show', compact('query', 'pieces', 'details'));
    }
}
