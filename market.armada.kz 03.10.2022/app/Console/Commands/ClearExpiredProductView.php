<?php

namespace App\Console\Commands;

use App\Models\ProductView;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ClearExpiredProductView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product_view_expired:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clean product_view record that has been store more than a week';

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
     * @return int
     */
    public function handle()
    {
        if(ProductView::whereRaw('DATE_ADD(created_at, INTERVAL 7 DAY) < now()')
            ->select('id','user_id','product_id','created_at')->delete()){
            echo 'kotak';
            return CommandAlias::SUCCESS;
        }
        return CommandAlias::FAILURE;
    }
}
