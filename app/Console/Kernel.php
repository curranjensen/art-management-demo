<?php

namespace App\Console;

use App\Console\Commands\DumpDatabase;
use App\Console\Commands\ExportCatalogue;
use App\Console\Commands\ExportFeatured;
use App\Console\Commands\ExportWeb;
use App\Console\Commands\ExportFilesize;
use App\Console\Commands\ImportExcelFile;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\BatchImageFilesize;
use App\Console\Commands\BatchWatermarkImages;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ImportExcelFile::class,
        BatchWatermarkImages::class,
        BatchImageFilesize::class,
        DumpDatabase::class,
        ExportCatalogue::class,
        ExportWeb::class,
        ExportFilesize::class,
        ExportFeatured::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
