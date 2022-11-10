<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Command\Command as CommandAlias;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ResetStoreUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update_store_user:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset store user_id to 0';

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
//        $stores_old = DB::table('stores_table')->select('id','title','user_id');
//        $stores_new = DB::table('stores_new')->select('id','title','user_id');
//
//        $stores_union = $stores_new->unionAll($stores_old);
//        $identical_stores =  DB::table($stores_union)->select('id','title')->groupBy('id','title')
//            ->havingRaw('COUNT(*) = 2')->orderBy('id')->get();
//
//
//        print_r("Updating...");
//        // trash code
//        foreach ($identical_stores as $identical_store){
//            //$identical_stores_old =  $stores_old->where('id',$identical_store->id)->get();
//            DB::table('stores_new')->where('id',$identical_store->id)->update(['user_id'=>0]);
//            $stores_old = DB::table('stores_table')->select('id','title','user_id');
//        }

        $products = Product::active()->select('id', 'title', 'images')->get();
        foreach ($products as $product) {

            try {
                if (count($product->images) > 0) {

                    echo $product->id . ' ' . $product->title . "\n";
                    print_r($product->images);
                    echo "\n\n";
                    $pathway = $product->images[0];
                    $img = Image::make(storage_path("app/public/$pathway"));
                    $img->resize(1000, 1000, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    Storage::put("public/cards/$pathway", $img);
                    $img->save(storage_path("app/public/cards/$pathway"), 70);
                }
            } catch (Exception $e) {
                print_r($e);
                continue;
            }
        }
            return CommandAlias::SUCCESS;

    }
}
