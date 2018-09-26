<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**Auth Routes**/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//    // Registration Routes...
//    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//    Route::post('register', 'Auth\RegisterController@register');
//
//    // Password Reset Routes...
//    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});

//--------

/**Admin Routes**/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'published']], function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::delete('/images/{id}', 'ImageController@destroy');

    Route::get('/sitemap', function (){
        \Illuminate\Support\Facades\Artisan::call('command:sitemap');
        return back()->with('success', 'Карта сайта успешно обновлена');
    })->name('sitemap');

    require_once('admin/actions.php');
    require_once('admin/tariffs.php');
    require_once('admin/tariff_categories.php');
    require_once('admin/faq_categories.php');
    require_once('admin/faqs.php');
    require_once('admin/news.php');
    require_once('admin/feedbacks.php');
    require_once('admin/clients.php');
    require_once('admin/users.php');
    require_once('admin/offices.php');
    require_once('admin/regions.php');
    require_once('admin/cities.php');
    require_once('admin/reports.php');
    require_once('admin/banners.php');
    require_once('admin/callbacks.php');
    require_once('admin/settings.php');
    require_once('admin/subscribers.php');
    require_once('admin/pages.php');
    require_once('admin/main.php');
    require_once('admin/vacancy_categories.php');
    require_once('admin/vacancy.php');
    require_once('admin/seo.php');
    require_once('admin/steps.php');

});

Route::group(['prefix' => App\Http\Middleware\LocaleMiddleware::getLocale(), 'middleware' => 'locale'], function () {


    Route::group(['namespace' => 'Site'], function () {

        Route::get('/', 'MainController@index')->name('site.home');

        //subscribe
        Route::post('/main/subscribe', 'MainController@subscribe')->name('subscribe');
        Route::get('/subscribers/activate', 'SubscriberController@activate')->name('activate');
        Route::post('/main/discount', 'MainController@discount')->name('main.discount');

        /**часто задаваемые вопросы**/
        Route::get('/faqs', 'FaqController@index')->name('faqs');

        /**новости**/

        Route::get('/news', 'NewsController@index')->name('news');
        Route::get('/news/{news}', 'NewsController@show')->name('news.show');


        /**тарифы**/
        Route::get('/tariffs', 'TariffCategoryController@index')->name('tariffs');

        /**финансовая отчетность**/
        Route::get('/reports', 'ReportController@index')->name('reports');
        Route::get('/reports/{report}', 'ReportController@show')->name('reports.show');
        Route::get('/reports/document/{path}', 'ReportController@downloadFile')->name('reports.download');

        /**callbacks**/
        Route::get('/callbacks/create', 'CallbackController@store')->name('callbacks.send');

        /**search**/
        Route::get('/search', 'SearchController@index')->name('search');

        /**Вакансии**/

        Route::get('/vacancies', 'VacancyController@index')->name('vacancies');


        /**акции**/

        Route::get('/actions', 'ActionController@index')->name('actions');
        Route::get('/actions/{actions}', 'ActionController@show')->name('actions.show');

        /**клиентам**/

        Route::get('/clients', 'ClientController@index')->name('clients');
        Route::get('/clients/{clients}', 'ClientController@show')->name('clients.show');


        Route::get('/departments', 'DepartmentController@index')->name('departments');
        Route::get('/departments/get-departments', 'DepartmentController@getDepartments');
        Route::get('/departments/{id}', 'DepartmentController@show')->name('departments.show');

        /**  calculator */

        Route::get('/calculator', function (){
            return view('site.calculator.calculator');
        })->name('calculator');
        Route::get('/special-abilities', function (){
            return view('site.calculator.special_abilities');
        })->name('special.abilities');

        // 404
        Route::get('/404', function (){
            return view('_layouts.404');
        })->name('404');

        /** Статические страницы **/

        Route::get('/{page}', 'PageController@show')->name('pages.show');
    });

});



//Переключение языков
Route::get('setlocale/{lang}', function ($lang) {

    $referer = \Illuminate\Support\Facades\Redirect::back()->getTargetUrl(); //URL предыдущей страницы

    $parse_url = parse_url($referer, PHP_URL_PATH); //URI предыдущей страницы

    //разбиваем на массив по разделителю
    $segments = explode('/', $parse_url);

    //Если URL (где нажали на переключение языка) содержал корректную метку языка
    if (in_array($segments[1], App\Http\Middleware\LocaleMiddleware::$languages)) {

        unset($segments[1]); //удаляем метку
    }

    //Добавляем метку языка в URL (если выбран не язык по-умолчанию)
    if ($lang != App\Http\Middleware\LocaleMiddleware::$mainLanguage) {
        array_splice($segments, 1, 0, $lang);
    }

    //формируем полный URL
    $url = implode("/", $segments);
//    $url = Request::root().implode("/", $segments);

    //если были еще GET-параметры - добавляем их
    if (parse_url($referer, PHP_URL_QUERY)) {

        $url = $url . '?' . parse_url($referer, PHP_URL_QUERY);
    }

    return redirect($url); //Перенаправляем назад на ту же страницу

})->name('setlocale');