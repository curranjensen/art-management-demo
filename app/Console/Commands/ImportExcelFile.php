<?php

namespace App\Console\Commands;

use Excel;
use App\Piece;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ImportExcelFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'excel:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports Excel data.';

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
     * @return mixed
     */
    public function handle()
    {
        if ($this->confirm('Do you wish to import Excel data?')) {

            $excelFile = storage_path('imports') . DIRECTORY_SEPARATOR . 'Inventory.xlsx';

            $this->info('Importing data from ' . $excelFile);

            Excel::load($excelFile, function($reader) {
               $inserts = $reader->all()->map(function($row) {
                    return [
                        'number' => (int) $row->number,
                        'name' => $row->name ?? null,
                        'size' => $row->size ?? null,
                        'month' => $row->month ? (int) $row->month : null,
                        'year' => $row->year ? (int) $row->year : null,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                });

                Piece::insert($inserts->toArray());

                $this->info("Imported {$inserts->count()} records");
            });
        }
    }
}