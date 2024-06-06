<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class optimizedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'optim:done';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'optimized Command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = base_path();

        Artisan::call('view:clear');
        Artisan::call('config:cache');
        Artisan::call('config:clear');
        Artisan::call('route:cache');
        Artisan::call('route:clear');

        info('Artisan command berjalan sukses -> '. \Carbon\Carbon::now()); 
        return Command::SUCCESS;
    }
}
