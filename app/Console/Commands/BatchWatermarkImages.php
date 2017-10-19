<?php

namespace App\Console\Commands;

use File;
use App\Detail;
use Illuminate\Console\Command;
use App\Services\ImageProcessor\ImageProcessor;

class BatchWatermarkImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:watermark';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resize and watermark Detail Images';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param ImageProcessor $imageProcessor
     * @return mixed
     */
    public function handle(ImageProcessor $imageProcessor)
    {
        File::cleanDirectory(storage_path('app/public/watermarked-batch/'));

        $details = Detail::select('details.*')
            ->join('pieces', 'pieces.id', '=', 'details.piece_id')
            ->orderBy('pieces.number')
            ->get();

        $count = count($details);

        $bar = $this->output->createProgressBar($count);

        foreach($details as $detail) {
            $imageProcessor->autoSaveWatermark($detail, storage_path('app/public/watermarked-batch/'));
            $bar->advance();
        }

        $bar->finish();

        $this->output->newLine();

        $this->info("Done. Processed $count images.");
    }
}