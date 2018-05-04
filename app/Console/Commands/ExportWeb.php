<?php

namespace App\Console\Commands;

use File;
use Storage;
use App\Detail;
use Illuminate\Console\Command;
use App\Services\ImageProcessor\ImageProcessor;

class ExportWeb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:web';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export images to featured folder';

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
        File::cleanDirectory(storage_path('app/public/web/'));

        $details = Detail::select('details.*')
            ->join('pieces', 'pieces.id', '=', 'details.piece_id')
            ->where('is_featured', true)
            ->orderBy('pieces.number')
            ->get();

        $count = count($details);

        $bar = $this->output->createProgressBar($count);

        foreach($details as $detail) {
            Storage::copy('public/details/' . $detail->piece->number . '/lg_' . $detail->file_name,
                'public/web/' . $detail->piece->number . '/lg_' . $detail->file_name);

            $fileName = sprintf('%s/%s/%s',
                storage_path('app/public/web'),
                $detail->piece->number,
                $detail->file_name);

            $imageProcessor->exportForFeatured($detail, null, $fileName);
            $bar->advance();
        }

        $bar->finish();

        $this->output->newLine();

        $this->info("Done. Processed $count images.");
    }
}