<?php

namespace App\Http\Controllers;

use App\Detail;
use Illuminate\Http\Request;
use App\Http\Requests\CropRequest;
use App\Repositories\DetailRepository;
use App\Services\ImageProcessor\ImageProcessor;

class DetailController extends Controller
{
    /**
     * @var DetailRepository
     */
    protected $repository;

    /**
     * DetailController constructor.
     * @param DetailRepository $repository
     */
    public function __construct(DetailRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the details.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = $this->getSort($request);

        $details = $this->repository->selectForIndex($sort);

        return $request->exists('grid') ? view('detail.index-grid', compact('details')) : view('detail.index', compact('details'));
    }

    /**
     * Display the specified detail.
     *
     * @param Detail $detail
     * @return \Illuminate\Http\Response
     */
    public function show(Detail $detail)
    {
        $previous = $this->repository->getPrevious($detail->piece, $detail);
        $next = $this->repository->getNext($detail->piece, $detail);

        return view('detail.show', compact('detail', 'previous', 'next'));
    }

    /**
     * Display a form to confirm deletion on detail.
     *
     * @param Detail $detail
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmDelete(Detail $detail)
    {
        return view('detail.confirm-delete', compact('detail'));
    }

    /**
     * Remove the specified detail from storage.
     *
     * @param Detail $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detail $detail)
    {
        $this->repository->kill($detail);

        flash('The detail has been deleted!', 'success');

        return redirect()->route('pieces.edit', $detail->piece->id);
    }

    /**
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
     * Determine if the sort is valid.
     *
     * @param $sort
     * @return bool
     */
    private function sortIsInvalid($sort): bool
    {
        return !count($sort) === 2 || !in_array($sort[0], ['id', 'name', 'number', 'year']) || !in_array($sort[1],
                ['asc', 'desc']);
    }

    /**
     * @param Detail $detail
     * @return \Illuminate\Http\JsonResponse
     */
    public function makeDefault(Detail $detail)
    {
        $this->repository->makeDefault($detail);

        return response()->json(['is_default' => true]);
    }

    /**
     * @param Detail $detail
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeDefault(Detail $detail)
    {
        $this->repository->removeDefault($detail);

        return response()->json(['is_default' => false]);
    }

    /**
     * Download the original detail file.
     *
     * @param Detail $detail
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadOriginal(Detail $detail)
    {
        return response()->download($detail->originalPath, str_slug($detail->piece->name()));
    }

    /**
     * Display the form for cropping the detail
     *
     * @param Detail $detail
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCrop(Detail $detail)
    {
        $previous = $this->repository->getPrevious($detail->piece, $detail);
        $next = $this->repository->getNext($detail->piece, $detail);

        return view('detail.crop', compact('detail', 'previous', 'next'));
    }

    /**
     * Perform the cropping of the detail and download it
     *
     * @param CropRequest $cropRequest
     * @param ImageProcessor $imageProcessor
     * @param Detail $detail
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function cropWatermark(CropRequest $cropRequest, ImageProcessor $imageProcessor, Detail $detail)
    {
        $imageProcessor->cropForWatermark($detail,
            request('colour'),
            request('size'),
            request('width'),
            request('height'),
            request('x'),
            request('y'));

        return response()->download($detail->watermarkedPath, str_slug($detail->piece->name() . '_watermarked'));
    }
}