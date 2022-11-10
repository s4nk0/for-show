<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;
use Elasticsearch\ClientBuilder;
use App\Repositories\ElasticsearchProductRepository;
use App\Repositories\ElasticsearchStoreRepository;

class ElasticSearch extends Component
{
    public $search ='';

    protected $queryString = ['search'];

    public function goTo($text){
        $this->search = $text;
    }

    public function render()
    {
        $client = ClientBuilder::create()
            ->setHosts([env('ELASTICSEARCH_HOSTS')])
            ->build();
        $product_query = new ElasticsearchProductRepository($client);
        $store_query = new ElasticsearchStoreRepository($client);

        $products = $product_query->search($this->search);
        $stores = $store_query->search($this->search);

        if (count($products) > 0){
            $subcatalog_id = $products->first()->subcatalog()->get()->pluck('id')->implode('');
        } else{
            $subcatalog_id = null;
        }

        $items = \App\Models\Item::where('subcatalog_id',$subcatalog_id)->where('isActive','1')->get();


            $suggest = $client->search(['body' => [

            "suggest" => [
                "text" => $this->search,
                "my-suggestion" => [
                    "phrase"=> [
                        "analyzer"=>"rus_en_key",
                        "field" => "title.trigram",
                        "size"=> 2,
                    "gram_size"=> 1,
                    "direct_generator"=> [ [
                    "field"=> "title.trigram",
                      "suggest_mode"=> "always"
                    ] ],
                        "highlight"=> [
                        "pre_tag"=> "<strong>",
                          "post_tag"=> "</strong>"
                        ],
                        "collate"=> [
                            "query"=> [
                                "inline"=> [
                                    "match"=> [
                                        "title"=> [
                                            "query"=> "{{ suggestion }}",
                                            "operator"=> "or"
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ],
])['suggest']['my-suggestion'][0]['options'];

        if (!isset($suggest)){
            $suggest= null;
        }

        if (isset($_COOKIE['search_history'])){
            $histories = json_decode($_COOKIE['search_history']);
            $filtered_history = [];
            foreach ($histories as $history){
                if (str_contains($history,$this->search)){
                    array_push($filtered_history,$history);
                }
            }
            $histories = $filtered_history;
        }else{
            $histories = null;
        }

        return view('livewire.search.elastic-search',compact('products','stores','items','suggest','histories'));
    }
}
