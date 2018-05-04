<?php

namespace App\Console\Commands;

use File;
use App\Detail;
use App\Services\ImageProcessor\ImageProcessor;
use Illuminate\Console\Command;

class ExportFilesize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:filesize {megabytes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exports all images of a given filesize';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param ImageProcessor $imageProcessor
     */
    public function handle(ImageProcessor $imageProcessor)
    {
        File::cleanDirectory(storage_path('app/public/filesize/'));

        $details = Detail::select('details.*')
            ->join('pieces', 'pieces.id', '=', 'details.piece_id')
            ->where('filesize', '>=', $this->getBytes())
            ->orderBy('pieces.number')
            ->get();

        $count = count($details);

        $bar = $this->output->createProgressBar($count);

        foreach($details as $detail) {

            $fileName = sprintf('%s/%s_%s_%s',
                storage_path('app/public/filesize'),
                $detail->piece->number,
                str_slug($detail->piece->name(), '_'),
                $detail->file_name);

            $imageProcessor->exportForFeatured($detail, null, $fileName);
            $bar->advance();
        }

        $bar->finish();

        $this->output->newLine();

        $this->info("Done. Processed $count images.");

    }

    /**
     * @return float
     */
    private function getBytes(): float
    {
        $bytes = round($this->argument('megabytes') * 1024 * 1024);
        return $bytes;
    }
}
