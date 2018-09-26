@extends('site.layouts.app')

@include('site.includes.meta_tags', array('meta_tags' => $page))

@section('content')
    <div id="achievements" class="achievementsPage page white-bg">

        <div class="mcontainer">
            <section class="pageSection pledgeSection">

                <div class="animated-border-block section-title grey-bg">
                    <div class="svg-container">
                        <svg class="rect-container">
                            <rect x="0" y="0" class="animatedBlock"/>
                            <rect x="0" y="0" stroke-width="4" class="overlappingBlock"/>
                        </svg>
                        <h2 class="title ">{{ $page['title_'.$locale] }}</h2>
                    </div>
                </div>


                <div class="sectionBlock">
                    {!! $page['description_'.$locale] !!}
                    {{--<main class="mrow flex wrap">--}}

                        {{--<article class="mcol-xs-12 mcol-sm-6 mcol-md-3">--}}
                            {{--<div class="achivement item">--}}
                                {{--<img src="/img/achivement-item_1.png" alt="achivement" class="achivement__img">--}}
                                {{--<p class="achivement__title">Лидер отрасли 2016</p>--}}
                            {{--</div>--}}
                        {{--</article>--}}

                        {{--<article class="mcol-xs-12 mcol-sm-6 mcol-md-3">--}}
                            {{--<div class="achivement item">--}}
                                {{--<img src="/img/achivement-item.jpg" alt="achivement" class="achivement__img">--}}
                                {{--<p class="achivement__title">Лидер отрасли 2016</p>--}}
                            {{--</div>--}}
                        {{--</article>--}}

                        {{--<article class="mcol-xs-12 mcol-sm-6 mcol-md-3">--}}
                            {{--<div class="achivement item">--}}
                                {{--<img src="/img/achivement-item.jpg" alt="achivement" class="achivement__img">--}}
                                {{--<p class="achivement__title">Лидер отрасли 2016</p>--}}
                            {{--</div>--}}
                        {{--</article>--}}

                        {{--<article class="mcol-xs-12 mcol-sm-6 mcol-md-3">--}}
                            {{--<div class="achivement item">--}}
                                {{--<img src="/img/achivement-item.jpg" alt="achivement" class="achivement__img">--}}
                                {{--<p class="achivement__title">Лидер отрасли 2016</p>--}}
                            {{--</div>--}}
                        {{--</article>--}}

                        {{--<article class="mcol-xs-12 mcol-sm-6 mcol-md-3">--}}
                            {{--<div class="achivement item">--}}
                                {{--<img src="/img/achivement-item.jpg" alt="achivement" class="achivement__img">--}}
                                {{--<p class="achivement__title">Лидер отрасли 2016</p>--}}
                            {{--</div>--}}
                        {{--</article>--}}

                        {{--<article class="mcol-xs-12 mcol-sm-6 mcol-md-3">--}}
                            {{--<div class="achivement item">--}}
                                {{--<img src="/img/achivement-item.jpg" alt="achivement" class="achivement__img">--}}
                                {{--<p class="achivement__title">Лидер отрасли 2016</p>--}}
                            {{--</div>--}}
                        {{--</article>--}}
                    {{--</main>--}}
                </div>
            </section>
        </div>

    </div>
@endsection