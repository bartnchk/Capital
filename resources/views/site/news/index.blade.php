@extends('site.layouts.app')

@include('site.includes.meta_tags')

@section('content')

    <!-- Start of page code insertion here -->
    <div id="newsListPage" class="newsListPage page">

        <section class="pageSection white-bg">
            <div class="mcontainer">
                <div class="sectionHeader">
                    <div class="animated-border-block section-title sectionHeaderItem">
                        <div class="svg-container">
                            <svg class="rect-container">
                                <rect x="0" y="0" class="animatedBlock"/>
                                <rect x="0" y="0" stroke-width="4" class="overlappingBlock"/>
                            </svg>
                            <h2 class="title">{{ __('main.news') }}</h2>
                        </div>
                    </div>

                    {{ Breadcrumbs::render('news') }}

                </div>

                <div class="sectionBlock filter-block flex wrap center">
                    <div class="formRow chosen-wrapper mcol-xs-12 mcol-sm-6">
                        <label for="1" class="title mcol-xs-12 mcol-sm-4">{{ __('main.show_news') }}</label>
                        <select name="region" id="region_id" data-placeholder="Всей Украины" class="mcol-xs-12 mcol-sm-4">
                            <option value="national">{{ __('main.all_news') }}</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}" @if(array_get($request, 'region') == $region->id) {{ 'selected' }} @endif>{{ $region['title_'.$locale] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="formRow chosen-wrapper mcol-xs-12 mcol-sm-6">
                        <label for="2" class="title mcol-xs-12 mcol-sm-4">Город: </label>
                        <select @if(!$current_region) {{ 'disabled' }} @endif name="city" id="city_id" data-placeholder="Все" class="mcol-xs-12 mcol-sm-4">
                            <option value="national">{{ __('main.all_news') }}</option>
                            @if( $current_region )
                                @foreach($current_region->cities as $city)
                                    <option value="{{ $city->id }}" @if(array_get($request, 'city') == $city->id) {{ 'selected' }} @endif>{{ $city['title_'.$locale] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>

            @php
                $counter = 0;
                if(isset($news[0])) $current_month = $news[0]->created_at->format('m');
            @endphp

            @if( !count($news) )
                <div class="sectionBlock no-items-block">
                    <div class="mcontainer">
                        <h2 class="title text-center no-items-title">{{ __('main.no_news') }}</h2>
                        <p class="text-center">{{ __('main.try_more') }}</p>
                    </div>
                </div>
            @endif

            @foreach($news as $i=>$item)

                @if($counter == 0 || $i == 6)
                    <div class="sectionBlock month-block">
                        <div class="mcontainer">
                            <h3 class="title sectionBlock-title">{{ \Jenssegers\Date\Date::parse($item->created_at)->format('F') }}</h3>
                            <div class="news-list mrow flex wrap">
                                @endif
                                <article class="news-item mcol-xs-12 mcol-md-4">
                                    <div class="item-container flex column">
                                        <div class="overlayed-date-container">
                                            <span>{{ \Jenssegers\Date\Date::parse($item->created_at)->format('d F Y') }}</span>
                                        </div>

                                        <div class="imgWrapper relative more-button overlayed">
                                            <a href="{{ route('news.show',  $item->alias) }}" class="absolute stretch overlay-link"></a>
                                            <div class="darkOverlay"></div>

                                            <div class="more-button-wrapper">
                                                <div class="more-button-container">
                                                    <a href="{{ route('news.show',  $item->alias) }}"
                                                       class="title semi-bold">{{ __('main.details') }}</a>
                                                    <i class="icomoon standard-arrow-icon"></i>
                                                </div>
                                            </div>

                                            @isset($item->image_small)
                                                <img src="{{ '/storage/images/news/'.$item->image_small }}" alt="{{ $item->title_ru }}">
                                            @elseif($item->image)
                                                <img src="{{ '/storage/images/news/thumbnails/'.$item->image }}" alt="{{ $item->title_ru }}">
                                            @else
                                                <img src="{{ asset('img/no_image_news.jpg') }}" alt="{{ $item->title_ru }}">
                                            @endisset

                                        </div>

                                        <div class="description-container flex column">
                                            <h4 class="title article-title"><a
                                                        href="{{ route('news.show',  $item->alias) }}">{{ $item['title_'.$locale] }}</a>
                                            </h4>
                                            <div class="description">
                                                <p class="">{!! strip_tags(str_limit($item['description_'.$locale], 155)) !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                @php
                                    $counter++;
                                @endphp

                                @if(isset($news[$i+1]) && ($news[$i+1]->created_at->format('m') !== $current_month) || $i == 5)
                            </div>
                        </div>
                    </div>

                    @php
                        $counter = 0;
                        if(isset($news[$i+1])) $current_month = $news[$i+1]->created_at->format('m');
                    @endphp
                @endif

                @if($loop->iteration == 6)

                    <div class="sectionBlock smallSection">
                        <div class="mcontainer">
                            <div class="content-wrapper">
                                <h2 class="title section-title">{{ __('main.get_news') }}</h2>

                                <form action="{{ route('subscribe') }}" class="subscribe-form">
                                    <div class="formRow relative">
                                        <input id="subscribe-email" class="border-decor" type="text" placeholder="Ваш email" data-text-color="white" data-validate="isEmail" data-error-text="Некорректный e-mail" name="email">
                                        <button id="subscribe" class="standardButton black border-decor submitButton">{{ __('main.subscribe') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

            @endforeach


            <div class="sectionBlock pagination">
                <div class="mcontainer">
                    {{ $news->appends($request)->links('site.includes.pagination') }}
                </div>
            </div>

        </section>
    </div>
    <!-- End of page code insertion here -->
@endsection

@section('scripts')

<script>
    $(document).ready(function () {

        var region = $('#region_id');
        var city = $('#city_id');
        region.chosen().change(function () {
            url = $(this).val() === 'national' ? '/news?national=1' : '/news?region=' + region.chosen().val();
            window.location.assign(url);
        });

        city.chosen().change(function () {
            url = $(this).val() === 'national' ? '/news?national=1' : window.location.search + '&city=' + city.chosen().val();
            window.location.assign(url);
        });
    });

</script>
@endsection


