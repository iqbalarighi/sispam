<?php

namespace App\Console;

use App\Models\IzinvalidasiModel;
use App\Models\IzinvendorModel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected $commands = [
        'App\Console\Commands\optimizedCommand'
    ];

    protected function schedule(Schedule $schedule)
    {
        $path = base_path();

        // $schedule->command('inspire')->hourly();
         // $schedule->call('config:cache')->dailyAt('20:04')->timezone('Asia/Jakarta');
         // $schedule->command('optim:done')->dailyAt('20:05')->timezone('Asia/Jakarta');
         $schedule->command('optim:done')->dailyAt('03:00')->timezone('Asia/Jakarta')
         ->onSuccess(function () {
             info('Schedule berjalan sukses di Kernel -> '. Carbon::now()); 
         })
         ->onFailure(function () {
             info('Schedule gagal dijalankan di Kernel -> '. Carbon::now()); 
         });

        $schedule->exec('cd /home/n1573881/pengamanan && composer dumpautoload -o')->dailyAt('03:00')->timezone('Asia/Jakarta')
         ->onSuccess(function () {
             info('composer berjalan sukses di Kernel -> '. Carbon::now()); 
         })
         ->onFailure(function () {
             info('composer gagal dijalankan di Kernel '. Carbon::now()); 
         });

         $schedule->exec("/home/n1573881/backup.sh")->hourly()
         ->onSuccess(function () {
             info('Backup berjalan sukses di Kernel -> '. Carbon::now()); 
         })
         ->onFailure(function () {
             info('Backup gagal dijalankan di Kernel '. Carbon::now()); 
         });

        $schedule->call(function () {
            foreach (IzinvalidasiModel::all() as $valid) {
                if($valid->mulai_granted != null){
                    $expired = Carbon::parse($valid->sampai_granted);
                    $status = IzinvendorModel::findorfail($valid->id);
                        
                        if ($status->status == "On Progress") {
                            if (Carbon::now() > $expired) {
                                 $status->status = "Expired";
                                 $status->save();
                            }
                        }
                    }
                }
            })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
