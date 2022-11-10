<?php

namespace App\Console\Commands;

use App\Http\Services\ProductService;
use App\Models\Product;
use App\Models\ProductTranslation;
use Illuminate\Console\Command;

class TransalteProduct extends Command
{

    protected ProductService $productService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translate:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Translate product from russian to kazakh';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        parent::__construct();
        $this->productService = $productService;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {


        $all_products = Product::select('id','title', 'description','manufacture','seo_title','meta_description','meta_tags')->get();

        foreach($all_products as $product){

            try {
                $translation_kz_product = $this->productService->translateToKazakh($product);

                ProductTranslation::firstOrCreate(
                    ['product_id' => $product->id, 'locale' => 'kz'],
                    $translation_kz_product
                );

                ProductTranslation::firstOrCreate(
                    ['product_id' => $product->id, 'locale' => 'ru'],
                    ['product_id' => $product->id, 'locale' => 'ru',
                        'title' => $product->title, 'description' => $product->description,
                        'manufacture'=>$product->manufacture,'seo_title'=>$product->seo_title,
                        'meta_description'=>$product->meta_description,'meta_tags'=>$product->meta_tags]
                );
            }catch (\Exception $exception){
                echo "error occurred in".$product->id;
                continue;
            }

            for($i = 0; $i <= 100; $i=$i+10){
                if(100 / count($all_products) == $i){
                    echo $i . '%';
                }
            }

        }

    }
}
