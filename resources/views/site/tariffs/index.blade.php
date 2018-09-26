@extends('site.layouts.app')

@include('site.includes.meta_tags')

@section('content')

    <div id="tariffsPage" class="tariffsPage page">

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
                                <h1 class="title">{{ trans('main.tariff_plans') }}</h1>
                            </div>
                        </div>

                        {{ Breadcrumbs::render('tariffs') }}
                    </div>
                </div>

                @if(count($categories))
                    <div class="sectionBlock">
                        <div class="tariffsCategoryNavBar categoryNavBar tabsNav">
                            <div class="mobileButtonsWrapper showButton "
                                 data-button-type="button" data-menu-type="drop-down" data-target="categoriesMenu">
                                <div class="arrow-button-container">
                                    <i class="icomoon icon-angle"></i>
                                </div>
                                <div class="active-category-container">
                                    <span class="">Под золото</span>
                                </div>
                            </div>

                            <div id="categoriesMenu" class="hiddenContent height tabButtons">
                                <div class="content-container">
                                    @forelse($categories as $category)
                                        <button data-target="tabBlock{{ $category->id }}" class="category tab @if($loop->iteration == 1) active @endif">{{ $category['title_'.$locale] }}</button>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="sectionBlock  toggleBlocks-list animation">
                    @forelse($categories as $category)
                        <div id="tabBlock{{ $category->id }}" class="toggleBlock active">
                            <div class="category-description description contentRow mcol-md-9">
                                <p>{{ $category['description_'.$locale] }}</p>
                            </div>

                            <div class="tariffs-list mrow flex wrap contentRow">
                                @forelse($category->tariffs as $tariff)
                                    <article class="tariff-item mcol-xs-12 mcol-sm-6 mcol-md-4">
                                        <div class="item-container flex column">
                                            <h3 class="title article-title">{{ $tariff['title_'.$locale] }}</h3>

                                            <div class="firstLevelWrapper">
                                                <div class="image-block">
                                                    <div class="img-header">
                                                        <span class="price">{{ $tariff['sub_title_first_'.$locale] }}</span>
                                                        <span>{{ $tariff['sub_title_second_'.$locale] }}</span>
                                                    </div>

                                                    <div class="imgWrapper">
                                                        {{--<img src="img/image_mock.jpg" alt="img">--}}
                                                        <img src="{{ asset('storage/images/tariffs/'.$tariff->image) }}" alt="img">
                                                    </div>
                                                </div>

                                                <div class="description-container flex column">
                                                    <div class="description">
                                                        <p>{{ $tariff['description_'.$locale] }}</p>
                                                        <ul class="conditions">
                                                            <li><b>{{ $tariff->rate }}</b></li>
                                                            <li><b>{{ $tariff['term_'.$locale] }}</b></li>
                                                            @isset($tariff['term_'.$locale]) <li>{{ trans('main.max_term') }}</li> @endisset
                                                        </ul>
                                                    </div>

                                                    @include('site.includes.calculate_button')
                                                    {{--<div class="more-button inversed">--}}
                                                        {{--<div class="more-button-wrapper">--}}
                                                            {{--<div class="more-button-container">--}}
                                                                {{--<a href="#" class="title semi-bold">Рассчитать мой кредит</a>--}}
                                                                {{--<i class="icomoon standard-arrow-icon inversed"></i>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                </div>
                                            </div>

                                        </div>
                                    </article>
                                @empty
                                    Нет тарифов в категории
                                @endforelse
                            </div>
                        </div>
                    @empty
                        Нет категорий
                    @endforelse

                </div>
            </div>
        </section>


    </div>
@endsection