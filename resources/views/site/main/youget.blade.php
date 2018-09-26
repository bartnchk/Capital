<section class="pageSection servicesSection">
    <div class="mcontainer">
        <div class="animated-border-block section-title">
            <div class="svg-container">
                <svg class="rect-container">
                    <rect x="0" y="0" class="animatedBlock"/>
                    <rect x="0" y="0" stroke-width="4" class="overlappingBlock"/>
                </svg>
                <h2 class="title ">{{ trans('main.you_get') }}</h2>
            </div>
        </div>

        <div id="services-list" class="flex wrap services-list 1show">

            @forelse($yougets as $youget)
                <article class="service-item mcol-xs-12 mcol-md-3">
                    <div class="top-icon-container">
                        <img src="{{ asset('storage/images/main/'.$youget->image) }}" alt="{{ $youget->title_ru }}">
                    </div>

                    <div class="arrow-container">
                        <i class="icomoon standard-arrow-icon"></i>
                    </div>

                    <div class="item-wrapper">
                        <div class="radius-clip top-clip"></div>
                        <div class="radius-clip bottom-clip"></div>

                        <div class="item-container">
                            <h4 class="title article-title">{{ $youget['title_'.$locale] }}</h4>
                            <div class="description">
                                <p>{{ $youget['description_'.$locale] }}</p>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
            @endforelse
        </div>
    </div>
</section>