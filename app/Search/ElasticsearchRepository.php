<?php

namespace App\Search;

use App\Models\Admin\Action;
use App\Models\Admin\News;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;

class ElasticsearchRepository implements SearchRepository
{
    private $search;
    public function __construct(Client $client) {
        $this->search = $client;
    }

    public function search(string $query = "")
    {
        $items = $this->searchOnElasticsearch($query);
        return $this->buildCollection($items);
    }

    private function searchOnElasticsearch(string $query): array
    {
        $news = new News;
        $action = new Action;

        $news_results = $this->getElasticResults($query, $news);

        $action_results = $this->getElasticResults($query, $action);

        $hits1 = array_pluck($news_results['hits']['hits'], '_source') ?: [];

        $hits2 = array_pluck($action_results['hits']['hits'], '_source') ?: [];

        $hits = array_merge($hits1 , $hits2);

        return $hits;
    }

    private function buildCollection(array $hits): \Illuminate\Support\Collection
    {
        /**
         * The data comes in a structure like this:
         * [
         *      'hits' => [
         *          'hits' => [
         *              [ '_source' => 1 ],
         *              [ '_source' => 2 ],
         *          ]
         *      ]
         * ]
         *
         * And we only care about the _source of the documents.
         */
        // We have to convert the results array into Eloquent Models.

        return collect($hits);
//        return News::hydrate($hits);
    }

    /**
     * @param string $query
     * @param $model
     */
    private function getElasticResults(string $query, $model)
    {
        return $this->search->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['title_ru', 'description_ru', 'title_uk', 'description_uk'],
                        'query' => $query,
                    ],
                ],
            ],
        ]);
    }
}