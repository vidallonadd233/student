<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServeWithChrome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:serve-with-chrome';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Laravel server...');
        exec('php artisan serve > /dev/null 2>&1 &');

        $this->info('Opening in Google Chrome...');
        if (PHP_OS_FAMILY === 'Windows') {
            exec('start chrome http://127.0.0.1:8000');
        } elseif (PHP_OS_FAMILY === 'Darwin') {
            exec('open -a "Google Chrome" http://127.0.0.1:8000');
        } else {
            exec('google-chrome http://127.0.0.1:8000');
        }

        $this->info('Server is running at http://127.0.0.1:8000');
    }
}
