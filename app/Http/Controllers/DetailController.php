<?php

namespace App\Http\Controllers;

use App\Http\Requests\CropOriginalRequest;
use App\Services\ImageProcessor\Cropper;
use Image;
use App\Detail;
use App\Http\Requests\RotateDetailRequest;
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

        $tags = $detail->tags->pluck('name');

        return view('detail.show', compact('detail', 'previous', 'next', 'tags'));
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
        $pieceNumber = $detail->piece->number;

        $this->repository->kill($detail);

        flash('The detail has been deleted!', 'success');

        return redirect()->route('pieces.edit', $pieceNumber);
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
     * @param Detail $detail
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCatalogue(Detail $detail)
    {
        $this->repository->addToCatalogue($detail);

        return response()->json(['in_catalogue' => true]);
    }

    /**
     * @param Detail $detail
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFromCatalogue(Detail $detail)
    {
        $this->repository->removeFromCatalogue($detail);

        return response()->json(['in_catalogue' => false]);
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
     * Display the form for cropping the detail
     *
     * @param Detail $detail
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCropOriginal(Detail $detail)
    {
        $previous = $this->repository->getPrevious($detail->piece, $detail);
        $next = $this->repository->getNext($detail->piece, $detail);

        return view('detail.crop-original', compact('detail', 'previous', 'next'));
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

        return response()->download($detail->watermarkedPath,
            str_slug($detail->piece->name() . '_watermarked'));
    }

    /**
     * Perform the cropping of the detail and download it
     *
     * @param CropOriginalRequest $cropRequest
     * @param Cropper $cropper
     * @param Detail $detail
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @internal param ImageProcessor $imageProcessor
     */
    public function cropOriginal(CropOriginalRequest $cropRequest, Cropper $cropper, Detail $detail)
    {
        $cropper->crop($detail,
            request('width'),
            request('height'),
            request('x'),
            request('y'));

        flash('The detail has been cropped!', 'success');

        return redirect()->back();
    }

    public function showRotate(Detail $detail)
    {
        $previous = $this->repository->getPrevious($detail->piece, $detail);
        $next = $this->repository->getNext($detail->piece, $detail);

        return view('detail.rotate', compact('detail', 'previous', 'next'));
    }

    public function rotate(Detail $detail, RotateDetailRequest $request)
    {
        $images = collect([
            $detail->absoluteLarge,
            $detail->absoluteThumbnail,
            $detail->originalPath
        ]);

        foreach ($images as $image) {
           $image = Image::make($image)->rotate((float) $request->angle)->save();
        }

        $detail->width = $image->width();
        $detail->height = $image->height();
        $detail->save();

        flash('The detail has been rotated!', 'success');

        return redirect()->back();
    }
}