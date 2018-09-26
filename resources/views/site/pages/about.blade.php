@extends('site.layouts.app')

@include('site.includes.meta_tags', array('meta_tags' => $page))

@section('content')

    <!-- Start of page code insertion here -->
    <div id="aboutUsPage" class="aboutUsPage page">

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
                                <h1 class="title">{{ $page['title_'.$locale] or '' }}</h1>
                            </div>
                        </div>

                        {{--@include('site.includes.breadcrumbs')--}}
                        {{ Breadcrumbs::render('pages.show', $page->id) }}
                    </div>
                </div>

                <div class="sectionBlock flex wrap">

                    <div class="sectionBlockColumn_sm image-block mcol-xs-12 mcol-sm-6">
                        <div class="contentRow relative">
                            <div class="main-image imgWrapper">
                                <img src="{{ asset('storage/images/page/'.$page->image) }}" alt="{{ $page->title_ru or '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="sectionBlockColumn_sm mcol-xs-12 mcol-sm-6">
                        <div class="contentRow">
                            <div class="description">
                                {!!  $page['description_'.$locale] or '' !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{--Вы получаете--}}
        @include('site.main.youget')

        {{--достижения--}}
        @include('site.main.achievements')

        <section class="pageSection gallerySection white-bg">
            <div class="mcontainer">
                <div class="mrow flex wrap">
                    @forelse($page->images as $image)
                        @if($loop->first)
                            <div class="gallery-block mcol-xs-12 mcol-sm-6">
                                <div class="imgWrapper">
                                    {{--<img src="{{ asset('storage/images/page/'.$image->path) }}" alt="{{ $page->title_ru }}">--}}
                                    <a class="colorbox" href="{{ asset('storage/images/page/'.$image->path) }}" data-rel="{{ count($page->images) }}">
                                        <img src="{{ asset('storage/images/page/'.$image->path) }}" alt="{{ $page->title_ru }}">
                                    </a>
                                </div>
                            </div>
                            <div class="gallery-block mcol-xs-12 mcol-sm-6">
                                <div class="mrow flex wrap">
                                    @foreach($page->images as $image)
                                        @if(!$loop->first)
                                            <div class="mcol-xs-6">
                                                <div class="imgWrapper">
                                                    <a class="colorbox" href="{{ asset('storage/images/page/'.$image->path) }}" data-rel="{{ count($page->images) }}">
                                                        <img src="{{ asset('storage/images/page/'.$image->path) }}" alt="{{ $page->title_ru }}">
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @empty
                    @endforelse
                </div>
            </div>
        </section>
    </div>

    <!-- End of page code insertion here -->

@endsection

@section('scripts')
    {{--<script src="{{asset('js/site/jquery.colorbox.min.js')}}"></script>--}}
@endsection