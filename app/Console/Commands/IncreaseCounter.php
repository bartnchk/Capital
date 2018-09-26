<?php

namespace App\Console\Commands;

use App\Models\Common\Achievement;
use Illuminate\Console\Command;

class IncreaseCounter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'counter:increase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command increase clients and credits counter';

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
        $achievements = Achievement::firstOrFail();
        $achievements->update([
            'clients' => $achievements->clients + 100,
            'credits' => $achievements->credits + 100
        ]);
    }
}
