@extends('site.layouts.app')

@include('site.includes.meta_tags')

@section('content')
    <!-- Start of page code insertion here -->
    <div id="vacanciesPage" class="vacanciesPage page">

        <section class="pageSection white-bg">
            <div class="mcontainer">

                <div class="sectionBlock">
                    <div class="sectionHeader">
                        <div class="animated-border-block section-title sectionHeaderItem">
                            <div class="svg-container">
                                <svg class="rect-container">
                                    <rect x="0" y="0" class="animatedBlock"/>
                                    <rect x="0" y="0" stroke-width="4" class="overlappingBlock"/>
                                </svg>
                                <h1 class="title">{{ __('main.vacancies') }}</h1>
                            </div>
                        </div>

                        {{ Breadcrumbs::render('vacancies') }}

                    </div>

                    <div class="description mcol-xs-12 mcol-md-7">
                        <p>Наша Компанія є найбільшою мережею ломбардів в Україні, і ми продовжуємо успішно розвиватися. Пропонуємо і вам стати частинкою нашої великої команди!
                            Ми цінуємо всіх наших співробітників і гарантуємо їм безкоштовне навчання, гідну заробітну плату, комфортні умови і можливість кар'єрного росту.</p>
                        <p class="text-right"><i>З повагою, Департамент Персоналу компанії.</i></p>
                    </div>
                </div>

                <div class="sectionBlock contentBlock mcol-xs-12 mcol-md-7">
                    <div class="description small-margin">
                        <p class="title">Нижче представлений перелік вакансій Компанії у різних містах України.</p>
                        <p>Також усі актуальні вакансії можна знайти на наших сторінках на сайтах пошуку роботи <a href="#"><b>rabota.ua</b></a> и <a href="#"><b>work.ua</b></a>.</p>

                        <p>Якщо Ви не знайшли підходящу вакансію, але хочете працювати в «Капiталi» - надсилайте резюме на електронну адресу - podbor@lombard.credit.</p>
                        <p>Ми обов'язково розглянемо Вашу кандидатуру.</p>
                    </div>
                </div>

                <div class="sectionBlock filter-block flex wrap center">
                    <div class="formRow chosen-wrapper mcol-xs-12 mcol-sm-6">
                        <label for="1" class="title mcol-xs-12 mcol-sm-4">{{ __('main.region') }}: </label>
                        <select name="city" id="city_id" data-placeholder="Все" class="mcol-xs-12 mcol-sm-4">
                            <option value="national">{{ __('main.all_cities') }}</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" @if(array_get($request, 'city') == $city->id) {{ 'selected' }} @endif>{{ $city['title_'.$locale] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="formRow chosen-wrapper mcol-xs-12 mcol-sm-6">
                        <label for="2" class="title mcol-xs-12 mcol-sm-4">{{ __('main.categories') }}: </label>
                        <select name="test" id="category_id" data-placeholder="Бухгалтерия - Налоги - Финансы предприятия" class="mcol-xs-12 mcol-sm-4">
                            <option value="all">{{ __('main.all_categories') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if(array_get($request, 'category') == $category->id) {{ 'selected' }} @endif>{{ $category['title_'.$locale] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="sectionBlock">
                    <ul class="vacancies-list">
                    @forelse($vacancies as $vacancy)
                        <li>
                            <div class="header-block showButton"
                                 data-group="vacancy-group" data-button-type="accordion" data-menu-type="drop-down">
                                <div class="content-container">
                                    <h3 class="title">{{ $vacancy['title_'.$locale] }}</h3>
                                    <div class="sub-title vacancy-info">
                                        <div><span>{{ $vacancy->city['title_'.$locale] }}</span></div>
                                        <div><span>{{ \Jenssegers\Date\Date::parse($vacancy->created_at)->format('d m Y') }}</span></div>
                                        <div><span>{{ $vacancy->salary }} @isset($vacancy->salary) грн. @endisset</span></div>
                                    </div>
                                </div>

                                <div class="arrow-button-container push-right">
                                    <i class="icomoon icon-angle"></i>
                                </div>
                            </div>

                            <div class="hiddenContent height vacancy-group">
                                <div class="content-container">
                                    <div class="description">
                                        {!! $vacancy['description_'.$locale] !!}

                                        @isset($vacancy->link )
                                        <p>
                                            <div class="more-button credit-button inversed">
                                                <div class="more-button-wrapper">
                                                    <div class="more-button-container">
                                                        <a href="{{ $vacancy->link }}" rel="nofollow" target="_blankпше " class="title semi-bold">{{ __('main.send_resume') }}</a>
                                                        <i class="icomoon standard-arrow-icon inversed"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </p>
                                        @endisset


                                    </div>
                                </div>
                            </div>
                        </li>
                        @empty
                            Извините, на текущий момент нет вакансий
                        @endforelse
                    </ul>
                </div>

            </div>
        </section>


    </div>

    <!-- End of page code insertion here -->

@endsection


@section('scripts')

    <script>
        $(document).ready(function () {

            var city = $('#city_id');
            var category = $('#category_id');
            var url ;
            city.chosen().change(function () {
                if ($(this).val() === 'national') {
                    url = $(this).val() === 'national' ? '/vacancies?national=1' : '/vacancies?city=' + city.chosen().val();
                }else {
                    url = category.chosen().val() !== 'all' ? '/vacancies?city=' + city.chosen().val() + '&category=' + category.chosen().val() : '/vacancies?city=' + city.chosen().val() ;
                }
                window.location.assign(url);
            });

            category.chosen().change(function () {
                if (city.chosen().val() === 'national' ) {
                    url = $(this).val() === 'all' ? '/vacancies?national=1&all=1' : '/vacancies?national=1&category=' + category.chosen().val();
                }else {
                    url = city.chosen().val() === 'all' ? '/vacancies?city='+ city.chosen().val() +'&all=1' : '/vacancies?city='+ city.chosen().val() + '&category=' + category.chosen().val();
                }
                window.location.assign(url);
            });
        });
    </script>

@endsection