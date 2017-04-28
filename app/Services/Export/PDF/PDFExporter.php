<?php namespace App\Services\Export\PDF;

use mikehaertl\wkhtmlto\Pdf;
use Storage;

class PDFExporter
{
    public function download($url, $fileName)
    {
        // delete previous file if there is one
        if(Storage::exists("public/export/{$fileName}")) {
            Storage::delete("public/export/{$fileName}");
        }

        $file = storage_path("app/public/export/{$fileName}");

        exec('xvfb-run /usr/bin/wkhtmltopdf --no-outline --disable-external-links --footer-center "[title]: [page] / [toPage]" --footer-font-size 10 --footer-spacing 5 --margin-top 5mm --margin-bottom 15mm --margin-left 5mm --margin-right 5mm ' . $url . ' ' . $file, $commandOutput, $returnVar);

        return response()->download($file);
    }
}