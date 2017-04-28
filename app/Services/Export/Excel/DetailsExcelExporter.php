<?php namespace App\Services\Export\Excel;

use Carbon\Carbon;

class DetailsExcelExporter extends ExcelExporter
{
    /**
     * @var \Illuminate\Database\Eloquent\Collection|static[]
     */
    private $details;

    /**
     * DetailsExcelExporter constructor.
     * @param \Illuminate\Database\Eloquent\Collection|static[] $details
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->details->map(function($detail) {
            return [
                'piece_id' => $detail->piece->number,
                'detail_id' => $detail->id,
                'file' =>  $detail->piece->number . '/'. $detail->file_name,
                'original' => $detail->original_file_name,
                'name' => $detail->piece->name,
                'dimensions' => $detail->piece->size,
                'image_size' => $detail->width . ' x ' . $detail->height,
                'month' => $detail->piece->month,
                'year' => $detail->piece->year,
            ];
        })->all();
    }

    /**
     * @return string
     */
    protected function getFileName()
    {
        return 'Details_' . Carbon::now()->format('Y_m_d');
    }

    protected function getSheetName()
    {
        return 'Details';
    }
}