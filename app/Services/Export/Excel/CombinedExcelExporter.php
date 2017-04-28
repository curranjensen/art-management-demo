<?php namespace App\Services\Export\Excel;

use Carbon\Carbon;
use Excel;

class CombinedExcelExporter
{
    /**
     * @var PiecesExcelExporter
     */
    private $piecesExcelExporter;
    /**
     * @var DetailsExcelExporter
     */
    private $detailsExcelExporter;

    /**
     * CombinedExcelExporter constructor.
     * @param PiecesExcelExporter $piecesExcelExporter
     * @param DetailsExcelExporter $detailsExcelExporter
     */
    public function __construct(PiecesExcelExporter $piecesExcelExporter, DetailsExcelExporter $detailsExcelExporter)
    {
        $this->piecesExcelExporter = $piecesExcelExporter;
        $this->detailsExcelExporter = $detailsExcelExporter;
    }

    /**
     * @return string
     */
    protected function getFileName()
    {
        return 'Inventory_' . Carbon::now()->format('Y_m_d');
    }

    public function download()
    {
        $pieces = $this->piecesExcelExporter->getData();
        $details = $this->detailsExcelExporter->getData();

        return Excel::create($this->getFileName(), function ($excel) use ($pieces, $details) {
            $excel->sheet('Pieces', function ($sheet) use ($pieces) {
                $sheet->fromArray($pieces);
            });
            $excel->sheet('Details', function ($sheet) use ($details) {
                $sheet->fromArray($details);
            });
        })->download('xlsx');
    }
}