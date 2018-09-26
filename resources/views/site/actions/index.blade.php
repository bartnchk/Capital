@extends('site.layouts.app')

@include('site.includes.meta_tags')

@section('content')

<!-- Start of page code insertion here -->
<div id="actionsListPage" class="actionsListPage page">

    <section class="pageSection white-bg">
        <div class="mcontainer sectionBlock">
            <div class="sectionHeader">
                <div class="animated-border-block section-title sectionHeaderItem">
                    <div class="svg-container">
                        <svg class="rect-container">
                            <rect x="0" y="0" class="animatedBlock"/>
                            <rect x="0" y="0" stroke-width="4" class="overlappingBlock"/>
                        </svg>
                        <h2 class="title">{{ __('main.our_actions') }}</h2>
                    </div>
                </div>

                {{ Breadcrumbs::render('actions') }}

            </div>

            <div class="sectionBlock filter-block flex wrap center">
                <div class="formRow chosen-wrapper mcol-xs-12 mcol-sm-6">
                    <label for="1" class="title mcol-xs-12 mcol-sm-4">{{ __('main.show_actions') }}</label>
                    <select name="city" id="city_id" data-placeholder="Все" class="mcol-xs-12 mcol-sm-4">
                        <option value="national">{{ __('main.all_cities') }}</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" @if(array_get($request, 'city') == $city->id) {{ 'selected' }} @endif>{{ $city['title_'.$locale] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="formRow chosen-wrapper mcol-xs-12 mcol-sm-6">
                    <label for="2" class="title mcol-xs-12 mcol-sm-4">{{ __('main.archive_actions') }}</label>
                    <select name="archive" id="archive" data-placeholder="Все" class="mcol-xs-12 mcol-sm-4">
                        <option value="all">{{ __('main.all') }}</option>
                        @foreach($archive as $key=>$item)
                            <option value="{{ \Jenssegers\Date\Date::parse($item->created_at)->format('Y-m') }}" @if(array_get($request, 'archive') == \Jenssegers\Date\Date::parse($item->created_at)->format('Y-m')) {{ 'selected' }} @endif>{{ \Jenssegers\Date\Date::parse($item->created_at)->format('F Y') }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="sectionBlock actions-block">
            <div class="mcontainer">

                <div class="actions-list mrow flex wrap">
                    @forelse($actions as $action)
                    <article class="action-item mcol-xs-12 mcol-md-4">
                        <div class="item-container flex column">
                            <div class="imgWrapper relative more-button overlayed">
                                <a href="{{ route('actions.show',  $action->alias) }}" class="absolute stretch overlay-link"></a>
                                <div class="darkOverlay"></div>

                                <div class="more-button-wrapper">
                                    <div class="more-button-container">
                                        <a href="{{ route('actions.show',  $action->alias) }}" class="title semi-bold">{{ __('main.details') }}</a>
                                        <i class="icomoon standard-arrow-icon"></i>
                                    </div>
                                </div>

                                <img src="{{ '/storage/images/action/'. $action->photo }}" alt="action">
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
                        Нет записей!
                    @endforelse

                </div>
            </div>
        </div>


        <div class="sectionBlock pagination">
            <div class="mcontainer">
                {{ $actions->appends($request)->links('site.includes.pagination') }}
            </div>
        </div>

    </section>
</div>

<!-- End of page code insertion here -->

@endsection


@section('scripts')

    <script>
        $(document).ready(function () {

            var city = $('#city_id');
            var archive = $('#archive');
            var url ;
            city.chosen().change(function () {
                if ($(this).val() === 'national') {
                    url = $(this).val() === 'national' ? '/actions?national=1' : '/actions?city=' + city.chosen().val();
                }else {
                    url = archive.chosen().val() !== 'all' ? '/actions?city=' + city.chosen().val() + '&archive=' + archive.chosen().val() : '/actions?city=' + city.chosen().val() ;
                }
                window.location.assign(url);
            });

            archive.chosen().change(function () {
                if (city.chosen().val() === 'national' ) {
                    url = $(this).val() === 'all' ? '/actions?national=1&all=1' : '/actions?national=1&archive=' + archive.chosen().val();
                }else {
                    url = city.chosen().val() === 'all' ? '/actions?city='+ city.chosen().val() +'&all=1' : '/actions?city='+ city.chosen().val() + '&archive=' + archive.chosen().val();
                }
                window.location.assign(url);
            });
        });
    </script>

@endsection