<?php

namespace App\Providers;

use App\Models\Admin\Settings;
use App\Models\Common\Feedback;
use App\Search\DatabaseRepository;
use App\Search\ElasticsearchRepository;
use App\Search\SearchRepository;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){

            $locale = app()->getLocale();

            $view->with(compact('locale'));
        });
        view()->composer('site.layouts.app', function($view){

            $feedbacks = Feedback::published()->latest()->take(10)->get();
            $settings = Settings::first();
            $view->with(compact('feedbacks', 'settings'));
        });

        Schema::defaultStringLength(191);

//        алиасы для полиморфных связей
        Relation::morphMap([
            'news' => \App\Models\Admin\News::class,
            'page' => \App\Models\Admin\Page::class,
            'action' => \App\Models\Admin\Action::class,
        ]);
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SearchRepository::class, function($app) {
            // This is useful in case we want to turn-off our
            // search cluster or when deploying the search
            // to a live, running application at first.
            if (!config('services.search.enabled')) {
                return new DatabaseRepository();
            }

            return new ElasticsearchRepository(
                $app->make(Client::class)
            );
        });

//        $this->app->bind(SearchRepository::class, ElasticsearchRepository::class);

        $this->app->bind(Client::class, function () {
            return ClientBuilder::create()
                ->setHosts(config('services.search.hosts'))
                ->build();
        });
    }
}
