<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DumpDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump database';

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
     * @return mixed
     */
    public function handle()
    {
        $date = date('Y-m-d');

        $filename = $date . '.sql';

        $this->call('db:backup', ['--database' => 'mysql', '--destination' => 'local', '--destinationPath' => $filename, '--compression' => 'null']);
    }
}
