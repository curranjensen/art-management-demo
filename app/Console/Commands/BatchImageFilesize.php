<?php

namespace App\Console\Commands;

use Image;
use Illuminate\Console\Command;
use App\Repositories\DetailRepository;

class BatchImageFilesize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:filesize';

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
     * @param DetailRepository $detailRepository
     * @return mixed
     */
    public function handle(DetailRepository $detailRepository)
    {

        $details = $detailRepository->all();

        $count = count($details);

        $bar = $this->output->createProgressBar($count);

        foreach($details as $detail) {
            try {
                $img = Image::make($detail->originalPath);
                $detail->filesize = $img->filesize();
                $detail->save();
            } catch (\Exception $e) {
                return;
            }
            $bar->advance();
        }

        $bar->finish();

        $this->output->newLine();

        $this->info("Done. Processed $count images.");
    }
}