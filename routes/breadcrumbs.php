<?php

use \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use App\Models\Admin\Page;
use App\Models\Admin\News;
use App\Models\Site\Report;

$locale = app()->getLocale();

// Home
Breadcrumbs::for('site.home', function ($trail) use ($locale) {
    $trail->push(trans('main.main'), route('site.home'));
});

// О компании
Breadcrumbs::for('about', function ($trail) {
    $trail->parent('site.home');
    $trail->push('О компании', route('about'));
});


// Статические страницы
    Breadcrumbs::for('pages.show', function ($trail, $id) use ($locale) {
        $page = Page::findOrFail($id);
        $trail->parent('site.home');
        $trail->push($page['title_' . $locale], route('pages.show', $page));
    });

// реквизиты и финансовая отчетность
    Breadcrumbs::for('reports', function ($trail) {
        $trail->parent('site.home');
        $trail->push(trans('main.financial_reports'), route('reports'));
    });

    Breadcrumbs::for('reports.show', function ($trail, $report) use ($locale) {
        $report = Report::findOrFail($report);
        $trail->parent('reports');
        $trail->push($report['title_' . $locale], route('reports.show', $report));
    });

    /**часто задаваемые вопросы**/

    Breadcrumbs::for('faqs', function ($trail) {
        $trail->parent('site.home');
        $trail->push(trans('main.faqs'), route('faqs'));
    });

    /**тарифы**/

    Breadcrumbs::for('tariffs', function ($trail) {
        $trail->parent('site.home');
        $trail->push(trans('main.tariff_plans'), route('tariffs'));
    });

//Новости
    Breadcrumbs::for('news', function ($trail) {
        $trail->parent('site.home');
        $trail->push(trans('main.news'), route('news'));
    });

//Новости Запись
    Breadcrumbs::for('news.show', function ($trail, $news) use ($locale) {
        $news = News::findOrFail($news);
        $trail->parent('news');
        $trail->push($news['title_' . $locale], route('news.show', $news));
    });

//Вакансии
    Breadcrumbs::for('vacancies', function ($trail) {
        $trail->parent('site.home');
        $trail->push(trans('main.vacancies'), route('vacancies'));
    });


//Акции
    Breadcrumbs::for('actions', function ($trail) {
        $trail->parent('site.home');
        $trail->push(trans('main.actions'), route('actions'));
    });

//Акции Запись
    Breadcrumbs::for('actions.show', function ($trail, $actions) use ($locale) {
        $actions = \App\Models\Admin\Action::findOrFail($actions);
        $trail->parent('actions');
        $trail->push($actions['title_' . $locale], route('actions.show', $actions));
    });

//Клиентам
    Breadcrumbs::for('clients', function ($trail) {
        $trail->parent('site.home');
        $trail->push(trans('main.for_clients'), route('clients'));
    });
//Клиентам Запись
Breadcrumbs::for('clients.show', function ($trail, $client) use ($locale) {
    $client = \App\Models\Common\Client::findOrFail($client);
    $trail->parent('clients');
    $trail->push($client['title_' . $locale], route('clients.show', $client));
});


//Отделения
Breadcrumbs::for('departments', function ($trail) {
    $trail->parent('site.home');
    $trail->push(trans('main.offices'), route('departments'));
});

Breadcrumbs::for('departments.show', function ($trail, $department) use ($locale) {
    $department = \App\Models\Common\Office::findOrFail($department);
    $trail->parent('departments');
    $trail->push(trans('main.office') .' №'. $department->number, route('departments.show', $department));
});
