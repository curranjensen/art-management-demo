<?php namespace App\Services\Export\Excel;

use Excel;

abstract class ExcelExporter
{
    abstract public function getData();
    abstract protected function getFileName();
    abstract protected function getSheetName();

    public function download()
    {
        $data = $this->getData();

        $sheet = $this->getSheetName();

        return Excel::create($this->getFileName(), function ($excel) use ($sheet, $data) {
            $excel->sheet($sheet, function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download('xlsx');
    }
}