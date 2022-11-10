<?php
namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductsRepository;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class ElasticsearchProductRepository implements ProductsRepository{
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
        $model = new Product;
        $items = $this->elasticsearch->search([
            'type' => $model->getSearchType(),
            'body' => [
                "size"=> 16,
                'query' => [
                    "bool"=>[
                        "must"=>
                            [
                                "multi_match"=>[
                                    "query"=>$query,
                                    "type"=> "bool_prefix",
                                    "fields"=>[
                                        "title",
                                        "title._2gram",
                                        "title._3gram",
                                        "title.en_rus_key",
                                        "title.my_ru_RU_dict_stemmer",
                                        "store.title",
                                        "store.title._2gram",
                                        "store.title._3gram",
                                        "store.title.en_rus_key",
                                    ],
                                    "operator"=>"or",
                                ]
                            ],
                        "filter"=>[
                            ["term" => ["isActive" => "1" ]],
                            ["term" => ["store.status" => "1" ]],
                        ],
                        "should"=>[
                            [
                                "multi_match"=>[
                                    "query"=>$query,
                                    "type"=> "bool_prefix",
                                    "fields"=>[
                                        "title",
                                        "title._2gram",
                                        "title._3gram",
                                        "title.en_rus_key",
                                        "title.my_ru_RU_dict_stemmer",
                                        "store.title",
                                        "store.title._2gram",
                                        "store.title._3gram",
                                        "store.title.en_rus_key",
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
        return Product::findMany($ids)
            ->sortBy(function ($products) use ($ids) {
                return array_search($products->getKey(), $ids);
            });
    }
}
