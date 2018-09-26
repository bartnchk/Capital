@extends('site.layouts.app')

@include('site.includes.meta_tags', array('meta_tags' => $page))

@section('content')

    <div id="creditsPage" class="creditsPage page">

        <section class="pageSection white-bg">
            <div class="mcontainer">
                <div class="sectionHeader sectionBlock">
                    <div class="animated-border-block section-title sectionHeaderItem">
                        <div class="svg-container">
                            <svg class="rect-container">
                                <rect x="0" y="0" class="animatedBlock"/>
                                <rect x="0" y="0" stroke-width="4" class="overlappingBlock"/>
                            </svg>
                            <h2 class="title">{{ $page['title_'.$locale] }}</h2>
                        </div>
                    </div>

                    {{ Breadcrumbs::render('pages.show', $page->id) }}

                </div>


                <div class="sectionBlock">
                    <div class="title-descr contentRow">{!! $page['description_'.$locale] !!}</div>

                    <div class="credit-steps-list contentRow mrow flex wrap">
                        @forelse($steps as $step)
                            <article class="credit-step-item mcol-xs-12 mcol-md-4">
                                <div class="item-container">
                                    <h4 class="title article-title"><span class="step-number">{{ $loop->iteration }}</span> {{ $step['title_'.$locale] }}</h4>
                                    <div class="description small-margin">
                                        <p>
                                          <span class="row-with-icon">
                                            <i class="icomoon icon-clock"></i>
                                            <span><b>{{ $step['time_'.$locale] }}</b></span>
                                          </span>
                                        </p>
                                        <p>{!! $step['description_'.$locale] !!}</p>
                                    </div>
                                </div>
                            </article>
                        @empty
                            На данный момент нет информации
                        @endforelse

                    </div>

                    <div class="wrapperBlock contentRow tariffs-button">
                        <a href="{{ route('tariffs') }}" class="standardButton white border-decor">{{ trans('main.discover_tariffs') }}</a>
                    </div>
                </div>

            </div>

        </section>
    </div>
@endsection