<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Jobs\ImportPlayers as ImportPlayersJob;

class ImportPlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'player:import';

    private $importPlayerJob;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to run import player Job';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        (new ImportPlayersJob())();
    }
}
