<section class="pageSection actionsSection white-bg">
    <div class="mcontainer relative">
        <div class="animated-border-block section-title">
            <div class="svg-container">
                <svg class="rect-container">
                    <rect x="0" y="0" class="animatedBlock"/>
                    <rect x="0" y="0" stroke-width="4" class="overlappingBlock"/>
                </svg>
                <h2 class="title ">{{ trans('main.our_actions') }}</h2>
            </div>
        </div>

        <div class="show-all-button-wrapper">
            <a href="{{ route('actions') }}" class="standardButton secondary border-decor">{{ trans('main.all_actions') }}</a>
        </div>

        <div class="mrow flex wrap">
            @forelse($actions as $action)
                <article class="action-item mcol-xs-12 mcol-md-4">
                    <div class="item-container flex column">
                        <div class="imgWrapper relative more-button overlayed">
                            <a href="{{ route('actions.show', ['actions' => $action->alias]) }}" class="absolute stretch overlay-link"></a>
                            <div class="darkOverlay"></div>

                            <div class="more-button-wrapper">
                                <div class="more-button-container">
                                    <a href="{{ route('actions.show', ['actions' => $action->alias]) }}" class="title semi-bold">{{ trans('main.details') }}</a>
                                    <i class="icomoon standard-arrow-icon"></i>
                                </div>
                            </div>
                            <img src="{{ asset('storage/images/action/'.$action->photo) }}" alt="{{ $action->title_ru }}">
                        </div>
                        <div class="description-container">
                            <div class="description">
                                <p class="row-with-icon date">
                                    <i class="icomoon icon-calendar"></i>
                                    <span class="text semi-bold">
                                        c {{ \Jenssegers\Date\Date::parse($action->start_at)->format('d F') }} по {{ \Jenssegers\Date\Date::parse($action->finish_at)->format('d F Y') }}
                                    </span>
                                </p>
                            </div>
                            <h4 class="title article-title"><a href="{{ route('actions.show', ['actions' => $action->alias]) }}">{{ $action['title_'.$locale] }}</a></h4>
                        </div>
                    </div>

                </article>
            @empty
            @endforelse

        </div>
    </div>
</section>