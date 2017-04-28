<?php

namespace App\Http\Controllers;

use App\Repositories\DetailRepository;
use App\Repositories\PieceRepository;
use App\Services\Export\PDF\PDFExporter;
use App\Services\Export\Excel\PiecesExcelExporter;
use App\Services\Export\Excel\DetailsExcelExporter;
use App\Services\Export\Excel\CombinedExcelExporter;

/**
 * Class ExportController
 * @package App\Http\Controllers
 */
class ExportController extends Controller
{
    /**
     * @var PDFExporter
     */
    protected $PDFExporter;
    /**
     * @var DetailRepository
     */
    protected $detailRepository;
    /**
     * @var PieceRepository
     */
    protected $pieceRepository;

    /**
     * ExportController constructor.
     *
     * @param PDFExporter $PDFExporter
     * @param DetailRepository $detailRepository
     * @param PieceRepository $pieceRepository
     */
    public function __construct(PDFExporter $PDFExporter, DetailRepository $detailRepository, PieceRepository $pieceRepository)
    {
        $this->PDFExporter = $PDFExporter;
        $this->detailRepository = $detailRepository;
        $this->pieceRepository = $pieceRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('export.index');
    }

    /**
     * @return mixed
     */
    public function downloadExcelDetails()
    {
        return (new DetailsExcelExporter($this->getDetails()))->download();
    }

    /**
     * @return mixed
     */
    public function downloadExcelPieces()
    {
        return (new PiecesExcelExporter($this->getPieces()))->download();
    }

    /**
     * @return mixed
     */
    public function downloadExcelCombined()
    {
        return (new CombinedExcelExporter(
                new PiecesExcelExporter($this->getPieces()),
                new DetailsExcelExporter($this->getDetails()))
                )->download();
    }

    /**
     * @return mixed
     */
    public function downloadPDFDetailsList()
    {
        return $this->PDFExporter->download(route('export.pdf.details.list.show'), 'details-list.pdf');
    }

    /**
     * @return mixed
     */
    public function downloadPDFPiecesList()
    {
        return $this->PDFExporter->download(route('export.pdf.pieces.list.show'), 'pieces-list.pdf');
    }

    /**
     * @return mixed
     */
    public function downloadPDFDetailsGrid()
    {
        return $this->PDFExporter->download(route('export.pdf.details.grid.show'), 'details-grid.pdf');
    }

    /**
     * @return mixed
     */
    public function downloadPDFPiecesGrid()
    {
        return $this->PDFExporter->download(route('export.pdf.pieces.grid.show'), 'pieces-grid.pdf');
    }

    /**
     * @return mixed
     */
    public function showPDFDetailsList()
    {
        return view('export.pdf.details-list', ['details' => $this->getDetails()]);
    }

    /**
     * @return mixed
     */
    public function showPDFPiecesList()
    {
        return view('export.pdf.pieces-list', ['pieces' => $this->getPieces()]);
    }

    /**
     * @return mixed
     */
    public function showPDFDetailsGrid()
    {
        return view('export.pdf.details-grid', ['details' => $this->getDetails()]);
    }

    /**
     * @return mixed
     */
    public function showPDFPiecesGrid()
    {
         return view('export.pdf.pieces-grid', ['pieces' => $this->getPieces()]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getDetails()
    {
        return $this->detailRepository->getAllForExport();
    }

    /**
     * @return mixed
     */
    private function getPieces()
    {
        return $this->pieceRepository->getAllForExport();
    }
}