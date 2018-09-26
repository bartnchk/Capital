<section class="pageSection pledgeSection white-bg">
    <div class="mcontainer">
        <div class="animated-border-block section-title">
            <div class="svg-container">
                <svg class="rect-container">
                    <rect x="0" y="0" class="animatedBlock"/>
                    <rect x="0" y="0" stroke-width="4" class="overlappingBlock"/>
                </svg>
                <h2 class="title ">{{ trans('main.on_bail') }}</h2>
            </div>
        </div>

        <div class="sectionBlock mainBlock">
            <div class="mrow flex wrap">
                @forelse($bails as $bail)
                    <article class="mcol-xs-12 mcol-sm-6 mcol-md-4">
                        <div class="item pledge-item main">
                            <a href="{{ route('calculator') }}" class="absolute stretch overlay-link"></a>
                            <div class="default-icon imgWrapper absolute">
                                {{--<img src="img/icons/ring.svg" alt="ring">--}}
                                <img src="{{ asset('storage/images/main/'.$bail->image_bw) }}" alt="{{ $bail->title_ru }}">
                            </div>

                            <div class="color-icon imgWrapper absolute">
                                {{--<img src="img/icons/ring_2.png" alt="ring">--}}
                                <img src="{{ asset('storage/images/main/'.$bail->image) }}" alt="{{ $bail->title_ru }}">
                            </div>

                            <div class="gold-container imgWrapper absolute">
                                <img src="img/money.png" alt="money.png">
                            </div>

                            <div class="calculate-button-container">
                                <span href="" class="title">{{ trans('main.calculate') }} <i class="icomoon standard-arrow-icon inversed"></i></span>
                            </div>

                            <div class="description-container">
                                <h4 class="title article-title">{{ $bail['title_'.$locale] }}</h4>
                                <div class="description">
                                    <p>{{ $bail['description_'.$locale] }}</p>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                @endforelse

            </div>
        </div>

        @include('site.main.abilities')

    </div>
</section>