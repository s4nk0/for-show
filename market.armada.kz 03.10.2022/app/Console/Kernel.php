<?php

namespace App\Console;

use App\Models\Product;
use App\Models\ProductView;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        Commands\ResetStoreUser::class,
        Commands\ClearExpiredProductView::class,
        Commands\TransalteProduct::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->command('inspire')->hourly();
//        $schedule->call(function () {
//            ProductView::whereRaw('DATE_ADD(created_at, INTERVAL 7 DAY) < now()')
//                ->select('id','user_id','product_id','created_at')->delete();
//        })->daily();
        $schedule->call('App\Http\Controllers\TestEmailController@sendEmailsCart')->everyMinute();
        $schedule->command('search:reindex')->everyMinute();
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
