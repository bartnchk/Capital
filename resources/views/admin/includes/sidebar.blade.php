<div id="mySidenav" class="sidenav">
    <ul>
        <li class="submenu-title"><a href="#" data-toggle="dropdown"  class="nav-link dropdown-toggle"><i class="fa fa-sticky-note" aria-hidden="true"></i>Контент<span class="caret"></span></a>
            <ul class="submenu">
                <li class="submenu-title"><a href="#"  data-toggle="dropdown"  class="nav-link dropdown-toggle"><i class="fa fa-sticky-note" aria-hidden="true"></i>Главная страница <span class="caret"></span></a>
                    <ul class="submenu">
                        <li id="youget" @if( basename(request()->path()) == 'youget') class="current" @endif ><a href="{{route('main.index', ['section' => 'youget'])}}">Вы получаете</a></li>
                        <li id="bail" @if( basename(request()->path()) == 'bail') class="current" @endif ><a href="{{route('main.index', ['section' => 'bail'])}}">Под залог</a></li>
                        <li id="ability" @if( basename(request()->path()) == 'ability') class="current" @endif ><a href="{{route('main.index', ['section' => 'ability'])}}">Специальные возможности</a></li>
                        <li id="achievements" @if(Route::is('main.achievements.edit')) class="current" @endif ><a href="{{ route('main.achievements.edit') }}">
                                Раздел достижения (счетчик)</a>
                        </li>
                    </ul>
                </li>
                <li id="pages" @if(Route::is('pages.index')) class="current" @endif ><a href="{{ route('pages.index') }}"><i class="fa fa-file" aria-hidden="true"></i>Статические страницы</a></li>
                <li id="steps" @if(Route::is('steps.index')) class="current" @endif ><a href="{{ route('steps.index') }}"><i class="fa fa-file" aria-hidden="true"></i>Шаги получения кредита</a></li>
                <li id="banners" @if(Route::is('banners.index')) class="current" @endif ><a href="{{ route('banners.index') }}"><i class="fa fa-picture-o" aria-hidden="true"></i>Баннеры</a></li>
                <li id="clients" @if(Route::is('clients.index')) class="current" @endif ><a href="{{ route('clients.index') }}"><i class="fa fa-user-o" aria-hidden="true"></i>Клиентам</a></li>
                <li id="news" @if(Route::is('news.index')) class="current" @endif ><a href="{{ route('news.index') }}"><i class="fa fa-bookmark" aria-hidden="true"></i>Новости</a></li>
                <li id="actions" @if(Route::is('admin.actions.index')) class="current" @endif ><a href="{{ route('admin.actions.index') }}"><i class="fa fa-commenting" aria-hidden="true"></i>Акции</a></li>

                <li class="submenu-title"><a href="#" data-toggle="dropdown"  class="nav-link dropdown-toggle"><i class="fa fa-sticky-note" aria-hidden="true"></i>Тарифы<span class="caret"></span></a>
                    <ul class="submenu">
                        <li id="tariff-categories" @if(Route::is('tariff_categories.index')) class="current" @endif ><a href="{{ route('tariff_categories.index') }}"><i class="fa fa-align-left" aria-hidden="true"></i>Категории</a></li>
                        <li id="tariffs" @if(Route::is('tariffs.index')) class="current" @endif ><a href="{{ route('tariffs.index') }}"><i class="fa fa-money" aria-hidden="true"></i>Тарифы</a></li>
                    </ul>
                </li>

                <li id="reports" @if(Route::is('reports.index')) class="current" @endif ><a href="{{ route('reports.index') }}"><i class="fa fa-money" aria-hidden="true"></i>Финансовая отчетность</a></li>

                <li class="submenu-title"><a href="#" data-toggle="dropdown"  class="nav-link dropdown-toggle"><i class="fa fa-sticky-note" aria-hidden="true"></i>Faq<span class="caret"></span></a>
                    <ul class="submenu">
                        <li id="faq-categories" @if(Route::is('faq_categories.index')) class="current" @endif ><a href="{{ route('faq_categories.index') }}"><i class="fa fa-question" aria-hidden="true"></i>Категории</a></li>
                        <li id="faqs" @if(Route::is('faqs.index')) class="current" @endif ><a href="{{ route('faqs.index') }}"><i class="fa fa-question" aria-hidden="true"></i>FAQ</a></li>
                    </ul>
                </li>

                <li id="offices" @if(Route::is('offices')) class="current" @endif ><a href="{{ route('offices') }}"><i class="fa fa-university" aria-hidden="true"></i>Отделения</a></li>

                <li class="submenu-title"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle"><i class="fa fa-sticky-note" aria-hidden="true"></i>Вакансии<span class="caret"></span></a>
                    <ul class="submenu">
                        <li id="vacancy-categories" @if(Route::is('vacancies.category.index')) class="current" @endif ><a href="{{ route('vacancies.category.index') }}"><i class="fa fa-tasks" aria-hidden="true"></i>Категории</a></li>
                        <li id="vacancies" @if(Route::is('vacancies.index')) class="current" @endif ><a href="{{ route('vacancies.index') }}"><i class="fa fa-users" aria-hidden="true"></i>Вакансии</a></li>
                    </ul>
                </li>

                <li id="feedbacks" @if(Route::is('feedbacks')) class="current" @endif ><a href="{{ route('feedbacks') }}"><i class="fa fa-commenting" aria-hidden="true"></i>Отзывы</a></li>
                <li id="settings" @if(Route::is('settings')) class="current" @endif ><a href="{{ route('settings') }}"><i class="fa fa-cog" aria-hidden="true"></i>Контакты</a></li>
            </ul>
        </li>
        <li class="submenu-title"><a href="#" data-toggle="dropdown"  class="nav-link dropdown-toggle"><i class="fa fa-calculator" aria-hidden="true"></i>Калькулятор<span class="caret"></span></a>
            <ul class="submenu">
                {{--<li class="submenu-title"><a href="#"  data-toggle="dropdown"  class="nav-link dropdown-toggle"><i class="fa fa-sticky-note" aria-hidden="true"></i>Главная страница <span class="caret"></span></a>--}}
                    {{--<ul class="submenu">--}}
                        {{--<li id="youget" @if( basename(request()->path()) == 'youget') class="current" @endif ><a href="{{route('main.index', ['section' => 'youget'])}}">Вы получаете</a></li>--}}
                        {{--<li id="bail" @if( basename(request()->path()) == 'bail') class="current" @endif ><a href="{{route('main.index', ['section' => 'bail'])}}">Под залог</a></li>--}}
                        {{--<li id="ability" @if( basename(request()->path()) == 'ability') class="current" @endif ><a href="{{route('main.index', ['section' => 'ability'])}}">Специальные возможности</a></li>--}}
                        {{--<li id="achievements" @if(Route::is('main.achievements.edit')) class="current" @endif ><a href="{{ route('main.achievements.edit') }}">--}}
                                {{--Раздел достижения (счетчик)</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                <li><a href="#"><i class="fa fa-calculator" aria-hidden="true"></i>Раздел калькулятора</a></li>
                {{--<li id="pages" @if(Route::is('pages.index')) class="current" @endif ><a href="{{ route('pages.index') }}"><i class="fa fa-file" aria-hidden="true"></i>Статические страницы</a></li>--}}
                {{--<li id="steps" @if(Route::is('steps.index')) class="current" @endif ><a href="{{ route('steps.index') }}"><i class="fa fa-file" aria-hidden="true"></i>Шаги получения кредита</a></li>--}}
                {{--<li id="banners" @if(Route::is('banners.index')) class="current" @endif ><a href="{{ route('banners.index') }}"><i class="fa fa-picture-o" aria-hidden="true"></i>Баннеры</a></li>--}}
                {{--<li id="clients" @if(Route::is('clients.index')) class="current" @endif ><a href="{{ route('clients.index') }}"><i class="fa fa-user-o" aria-hidden="true"></i>Клиентам</a></li>--}}
                {{--<li id="news" @if(Route::is('news.index')) class="current" @endif ><a href="{{ route('news.index') }}"><i class="fa fa-bookmark" aria-hidden="true"></i>Новости</a></li>--}}
                {{--<li id="actions" @if(Route::is('admin.actions.index')) class="current" @endif ><a href="{{ route('admin.actions.index') }}"><i class="fa fa-commenting" aria-hidden="true"></i>Акции</a></li>--}}

                {{--<li class="submenu-title"><a href="#" data-toggle="dropdown"  class="nav-link dropdown-toggle"><i class="fa fa-sticky-note" aria-hidden="true"></i>Тарифы<span class="caret"></span></a>--}}
                    {{--<ul class="submenu">--}}
                        {{--<li id="tariff-categories" @if(Route::is('tariff_categories.index')) class="current" @endif ><a href="{{ route('tariff_categories.index') }}"><i class="fa fa-align-left" aria-hidden="true"></i>Категории</a></li>--}}
                        {{--<li id="tariffs" @if(Route::is('tariffs.index')) class="current" @endif ><a href="{{ route('tariffs.index') }}"><i class="fa fa-money" aria-hidden="true"></i>Тарифы</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                {{--<li id="reports" @if(Route::is('reports.index')) class="current" @endif ><a href="{{ route('reports.index') }}"><i class="fa fa-money" aria-hidden="true"></i>Финансовая отчетность</a></li>--}}

                {{--<li class="submenu-title"><a href="#" data-toggle="dropdown"  class="nav-link dropdown-toggle"><i class="fa fa-sticky-note" aria-hidden="true"></i>Faq<span class="caret"></span></a>--}}
                    {{--<ul class="submenu">--}}
                        {{--<li id="faq-categories" @if(Route::is('faq_categories.index')) class="current" @endif ><a href="{{ route('faq_categories.index') }}"><i class="fa fa-question" aria-hidden="true"></i>Категории</a></li>--}}
                        {{--<li id="faqs" @if(Route::is('faqs.index')) class="current" @endif ><a href="{{ route('faqs.index') }}"><i class="fa fa-question" aria-hidden="true"></i>FAQ</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                {{--<li id="offices" @if(Route::is('offices')) class="current" @endif ><a href="{{ route('offices') }}"><i class="fa fa-university" aria-hidden="true"></i>Отделения</a></li>--}}

                {{--<li class="submenu-title"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle"><i class="fa fa-sticky-note" aria-hidden="true"></i>Вакансии<span class="caret"></span></a>--}}
                    {{--<ul class="submenu">--}}
                        {{--<li id="vacancy-categories" @if(Route::is('vacancies.category.index')) class="current" @endif ><a href="{{ route('vacancies.category.index') }}"><i class="fa fa-tasks" aria-hidden="true"></i>Категории</a></li>--}}
                        {{--<li id="vacancies" @if(Route::is('vacancies.index')) class="current" @endif ><a href="{{ route('vacancies.index') }}"><i class="fa fa-users" aria-hidden="true"></i>Вакансии</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                {{--<li id="feedbacks" @if(Route::is('feedbacks')) class="current" @endif ><a href="{{ route('feedbacks') }}"><i class="fa fa-commenting" aria-hidden="true"></i>Отзывы</a></li>--}}
                {{--<li id="settings" @if(Route::is('settings')) class="current" @endif ><a href="{{ route('settings') }}"><i class="fa fa-cog" aria-hidden="true"></i>Контакты</a></li>--}}
            </ul>
        </li>

        <li id="subscribers" @if(Route::is('subscribers')) class="current" @endif ><a href="{{ route('subscribers') }}"><i class="fa fa-rss" aria-hidden="true"></i>Подписчики</a></li>
        <li id="users" @if(Route::is('users')) class="current" @endif ><a href="{{ route('users') }}"><i class="fa fa-user-o" aria-hidden="true"></i>Пользователи</a></li>
        <li id="callbacks" @if(Route::is('callbacks.index')) class="current" @endif ><a href="{{ route('callbacks.index') }}"><i class="fa fa-phone" aria-hidden="true"></i>Заявки на звонок</a></li>
        <li id="seo" @if(Route::is('seo.index')) class="current" @endif ><a href="{{ route('seo.index') }}"><i class="fa fa-file" aria-hidden="true"></i>SEO раздел</a></li>
        <li id="regions" @if(Route::is('regions')) class="current" @endif ><a href="{{ route('regions') }}"><i class="fa fa-map" aria-hidden="true"></i>Регионы</a></li>
        <li id="cities" @if(Route::is('cities')) class="current" @endif ><a href="{{ route('cities') }}"><i class="fa fa-map-marker" aria-hidden="true"></i>Города</a></li>
        <li id="sitemap" @if(Route::is('sitemap')) class="current" @endif><a href="{{ route('sitemap') }}"><i class="fa fa-file-code-o" aria-hidden="true"></i>SiteMap XML</a></li>

        <li><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></li>
        <!-- Authentication Links -->
        <li class="nav-item dropdown">
            <a class="nav-link " href="{{ route('logout') }}"
               onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out" aria-hidden="true"></i>Выйти ({{ Auth::user()->name }})
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
    <ul>
        <li><a href="{{ route('site.home') }}" target="_blank"><i class="fa fa-share" aria-hidden="true"></i>На сайт</a>
        </li>
    </ul>
</div>

<span onclick="openNav()" class="bars-btn">
    <i class="fa fa-bars" aria-hidden="true"></i>
</span>
