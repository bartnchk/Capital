<div class="sectionBlock">
    <h3 class="title sectionBlock-title">{{ trans('main.special_abilities') }}</h3>
    <div class="mrow flex wrap">

        @forelse($abilities as $ability)
            <article class="mcol-xs-12 mcol-sm-6 mcol-md-3">
                <div class="item pledge-item special more-button overlayed">
                    <a href="#" class="absolute stretch overlay-link"></a>
                    <div class="darkOverlay"></div>

                    <div class="more-button-wrapper">
                        <div class="more-button-container">
                            <span href="#" class="title semi-bold">{{ trans('main.details') }}</span>
                            <i class="icomoon standard-arrow-icon"></i>
                        </div>
                    </div>

                    <div class="default-icon imgWrapper absolute">
                        <img src="{{ asset('storage/images/main/'.$ability->image) }}" alt="{{ $ability->title_ru }}">
                    </div>

                    <div class="description-container">
                        <h4 class="title article-title">{{ $ability['title_'.$locale] }}</h4>
                        <div class="description">
                            <p>{{ $ability['description_'.$locale] }}</p>
                        </div>
                    </div>
                </div>
            </article>
        @empty
        @endforelse

    </div>
</div>