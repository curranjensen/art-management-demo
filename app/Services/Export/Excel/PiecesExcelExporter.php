<?php namespace App\Services\Export\Excel;

use Carbon\Carbon;

class PiecesExcelExporter extends ExcelExporter
{
    /**
     * @var \Illuminate\Database\Eloquent\Collection|static[]
     */
    private $pieces;

    /**
     * PiecesExcelExporter constructor.
     * @param \Illuminate\Database\Eloquent\Collection|static[] $pieces
     */
    public function __construct($pieces)
    {
        $this->pieces = $pieces;
    }

    public function getData()
    {
       return $this->pieces->map(function($piece){
            return [
                'piece_id' => $piece->number,
                'name' => $piece->name,
                'details' => $piece->details_count,
                'dimensions' => $piece->size,
                'month' => $piece->month,
                'year' => $piece->year,
            ];
        })->all();
    }

    /**
     * @return string
     */
    protected function getFileName()
    {
        return 'Pieces_' . Carbon::now()->format('Y_m_d');
    }

    protected function getSheetName()
    {
        return 'Pieces';
    }
}