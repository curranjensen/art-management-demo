<?php

namespace App\Http\Controllers;

use App\Piece;
use App\Medium;
use Illuminate\Http\Request;
use App\Repositories\PieceRepository;
use App\Http\Requests\CreatePieceRequest;
use App\Http\Requests\ModifyPieceRequest;

class PieceController extends Controller
{
    /**
     * @var PieceRepository
     */
    protected $repository;

    /**
     * PieceController constructor.
     * @param PieceRepository $repository
     */
    public function __construct(PieceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the pieces.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $media = Medium::all();

        $sort = $this->getSort($request);

        $medium = request('media_id', false);

        $pieces = $this->repository->selectForIndex($sort, $medium);

        return view('piece.index', compact('media', 'pieces'));
    }

    /**
     * Show the form for creating a new piece.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suggestedPieceNumber = $this->repository->getNextPieceNumber();

        $media = Medium::all();

        return view('piece.create', compact('suggestedPieceNumber', 'media'));
    }

    /**
     * Store a newly created piece in storage.
     *
     * @param CreatePieceRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePieceRequest $request)
    {
        $piece = $this->repository->create($request->only([
            'name', 'size', 'month', 'year', 'number', 'notes', 'status', 'licences', 'media_id'
        ]));

        flash('The piece has been created!', 'success');

        return redirect()->route('pieces.edit', $piece->number);
    }

    /**
     * Display the specified piece.
     *
     * @param  Piece  $piece
     * @return \Illuminate\Http\Response
     */
    public function show(Piece $piece)
    {
        $previous = $this->repository->getPrevious($piece);
        $next = $this->repository->getNext($piece);

        return view('piece.show', compact('piece', 'previous', 'next'));
    }

    /**
     * Show the form for editing the specified piece.
     *
     * @param Piece $piece
     * @return \Illuminate\Http\Response
     */
    public function edit(Piece $piece)
    {
        $previous = $this->repository->getPrevious($piece);
        $next = $this->repository->getNext($piece);

        $media = Medium::all();

        return view('piece.edit', compact('piece', 'previous', 'next', 'media'));
    }

    /**
     * Update the specified piece in storage.
     *
     * @param ModifyPieceRequest $request
     * @param Piece $piece
     * @return \Illuminate\Http\Response
     */
    public function update(ModifyPieceRequest $request, Piece $piece)
    {
        $this->repository->update($piece, $request->only([
            'name', 'size', 'month', 'year', 'licences', 'notes', 'status', 'media_id'
        ]));

        flash('The piece has been updated!', 'success');

        return redirect()->back();
    }

    /**
     * Show the form for deleting a piece
     *
     * @param Piece $piece
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmDelete(Piece $piece)
    {
        return view('piece.confirm-delete', compact('piece'));
    }

    /**
     * Remove the specified pieces from storage.
     *
     * @param Piece $piece
     * @return \Illuminate\Http\Response
     */
    public function destroy(Piece $piece)
    {
        $this->repository->kill($piece);

        flash('The piece has been deleted!', 'success');

        return redirect()->route('pieces.index');
    }

    /**
     * Validate the sort request
     *
     * @param Request $request
     * @return array|bool
     */
    private function getSort(Request $request)
    {
        if ($request->exists('sort')) {
            $sort = explode('-', $request->get('sort'));
            if ($this->sortIsInvalid($sort)) {
                return false;
            }
            return $sort;
        }
        return false;
    }

    /**
     * @param $sort
     * @return bool
     */
    private function sortIsInvalid($sort): bool
    {
        return !count($sort) === 2 || !in_array($sort[0], ['name', 'number', 'year']) || !in_array($sort[1],
                ['asc', 'desc']);
    }
}