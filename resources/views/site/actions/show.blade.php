@extends('site.layouts.app')

@include('site.includes.meta_tags', array('meta_tags' => $action))

@section('content')

    <!-- Start of page code insertion here -->
    <div id="actionPage" class="actionPage page">

        <section class="pageSection white-bg">
            <div class="mcontainer">

                <div class="sectionBlock">
                    <div class="sectionHeader">
                        <h1 class="title article-title">{{ $action['title_'.$locale] }}</h1>

                        {{ Breadcrumbs::render('actions.show', $action->id) }}

                    </div>
                </div>

                <div class="sectionBlock contentBlock">

                    <div class="contentRow relative">
                        @if(!empty($action->wide_photo))
                        <div class="main-image imgWrapper">
                            <img src="{{ '/storage/images/action/'.$action->wide_photo }}" alt="img">
                        </div>
                        @endif
                    </div>

                    @include('site.includes.share')

                    <div class="contentRow">
                        <h2 class="title">{{ __('main.from') }} {{ \Jenssegers\Date\Date::parse($action->start_at)->format('d F ') }} {{ __('main.to') }} {{ \Jenssegers\Date\Date::parse($action->finish_at)->format('d F Y') }}</h2>
                        <div class="description mcol-xs-12 mcol-md-7">
                            {!! $action['description_'.$locale] !!}
                        </div>
                    </div>

                    @isset($action->link)
                    <div class="contentRow">
                        <h3 class="title">{{ __('main.action_conditions') }}</h3>
                            <a href="{{ $action->link }}" target="_blank" class="link-with-icon"><i class="icomoon icon-link"></i> <span>@if($action->link_title) {{ $action->link_title }}  @else {{ 'https://www.youtube.com/' }} @endif</span></a>
                    </div>
                    @endisset

                    <div class="contentRow images-row mrow flex wrap ">
                        @forelse($action->images as $image)
                        <div class="imgWrapper mcol-xs-6 mcol-sm-4 mcol-md-3">
                            <a class="colorbox" href="{{ '/storage/images/action/'.$image->path }}" data-rel="group{{$loop->iteration}}">
                                <img src="{{ '/storage/images/action/'.$image->path }}" alt="img">
                            </a>
                        </div>
                            @empty
                        @endforelse
                    </div>
                </div>

                <div class="sectionBlock">

                    @include('site.includes.calculate_button')

                </div>
            </div>
        </section>
    </div>

    <!-- End of page code insertion here -->
@endsection
