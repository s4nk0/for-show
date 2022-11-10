<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\Store;
use Elasticsearch\Client;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all articles to Elasticsearch';
    /** @var \Elasticsearch\Client */
    private $elasticsearch;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $elasticsearch)
    {
        parent::__construct();
        $this->elasticsearch = $elasticsearch;
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $counter  = 0;
        $this->info('Indexing all products. This might take a while...');


        foreach (Product::select('id','isActive','title','store_id','price')->get() as $product)
        {
            $this->elasticsearch->index([
                'index' => $product->getSearchIndex(),
                'id' => $product->getKey(),
                'body' => $product->toSearchArray(),
            ]);
            $this->output->write(".");
            $counter++;
        }
        $this->info('\Product added count: '.$counter);
        $counter=0;

        $this->info('Indexing all stores. This might take a while...');
        foreach (Store::select('id','status','title','mini_desc')->get() as $store)
        {
            $this->elasticsearch->index([
                'index' => $store->getSearchIndex(),
                'id' => $store->getKey(),
                'body' => $store->toSearchArray(),
            ]);
            $this->output->write('.');
            $counter++;
        }
        $this->info('\Store added count: '.$counter);
        $this->info('\nDone!');
    }
}
