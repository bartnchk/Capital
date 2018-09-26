<section class="pageSection newsSection white-bg">
    <div class="mcontainer relative">
        <div class="animated-border-block section-title">
            <div class="svg-container">
                <svg class="rect-container">
                    <rect x="0" y="0" class="animatedBlock"/>
                    <rect x="0" y="0" stroke-width="4" class="overlappingBlock"/>
                </svg>
                <h2 class="title ">{{ trans('main.last_news') }}</h2>
            </div>
        </div>

        <div class="show-all-button-wrapper">
            <a href="{{ route('news') }}" class="standardButton secondary border-decor">{{ trans('main.all_news') }}</a>
        </div>


        <div class="mrow flex wrap">
            @forelse($news as $item)
                <article class="news-item mcol-xs-12 mcol-md-4">
                    <div class="item-container flex column">
                        <div class="overlayed-date-container">
                            <span>{{ \Jenssegers\Date\Date::parse($item->created_at)->format('d F Y') }}</span>
                        </div>

                        <div class="imgWrapper relative more-button overlayed">
                            <a href="{{ route('news.show', ['news' => $item->alias]) }}" class="absolute stretch overlay-link"></a>
                            <div class="darkOverlay"></div>

                            <div class="more-button-wrapper">
                                <div class="more-button-container">
                                    <a href="{{ route('news.show', ['news' => $item->alias]) }}" class="title semi-bold">{{ trans('main.details') }}</a>
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
                            <h4 class="title article-title"><a href="{{ route('news.show', ['news' => $item->alias]) }}">{{ $item['title_'.$locale] }}</a></h4>
                            <div class="description">
                                <p class="">{!! mb_strimwidth(strip_tags($item['description_'.$locale]), 0, 200) !!}</p>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
            @endforelse

        </div>
    </div>
</section>