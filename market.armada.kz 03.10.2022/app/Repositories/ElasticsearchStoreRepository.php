<?php
namespace App\Repositories;

use App\Models\Product;
use App\Models\Store;
use App\Repositories\Interfaces\ProductsRepository;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class ElasticsearchStoreRepository implements ProductsRepository{
    /** @var \Elasticsearch\Client */
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function search(string $query = ''): Collection
    {
        $items = $this->searchOnElasticsearch($query);

        return $this->buildCollection($items);
    }

    private function searchOnElasticsearch(string $query = ''): array
    {
        $model = new Store;

        $items = $this->elasticsearch->search([
            'index' => $model->getSearchType(),
            'body' => [
                "size"=> 16,
                'query' => [

                    "bool"=>[
                        "filter"=>[
                            "term" => ["status" => "1" ]
                        ],
                        "must"=>
                            [
                                "multi_match"=>[
                                    "query"=>$query,
                                    "type"=> "bool_prefix",
                                    "fields"=>[
                                        "title^2",
                                        "*title*",
                                        "title._2gram",
                                        "title._3gram",
                                        "mini_desc",
                                        "*mini_desc*",
                                        "mini_desc._2gram",
                                        "mini_desc._3gram",
                                    ],
                                    "operator"=>"or",
                                ]
                            ],
                        "should"=>[
                            [
                                "multi_match"=>[
                                    "query"=>$query,
                                    "type"=> "bool_prefix",
                                    "fields"=>[
                                        "title",
                                        "*title*",
                                        "title._2gram",
                                        "title._3gram",
                                        "mini_desc",
                                        "*mini_desc*",
                                        "mini_desc._2gram",
                                        "mini_desc._3gram",
                                    ],
                                    "operator"=>"and",
                                ]
                            ],
                        ]
                    ],
                ],
            ],

        ]);
        return $items;
    }

    private function buildCollection(array $items): Collection
    {

        $ids = Arr::pluck($items['hits']['hits'], '_id');

        return Store::findMany($ids)
            ->sortBy(function ($stores) use ($ids) {
                return array_search($stores->getKey(), $ids);
            });
    }
}
