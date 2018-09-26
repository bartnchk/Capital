@extends('site.layouts.app')

@include('site.includes.meta_tags', array('meta_tags' => $page))

@section('content')
    <div id="aboutContactsPage" class="aboutContactsPage page">

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
                                <h1 class="title">{{ $page['title_'.$locale] }}</h1>
                            </div>
                        </div>
                        {{ Breadcrumbs::render('pages.show', $page->id) }}
                    </div>
                </div>

                <div class="sectionBlock contentBlock flex wrap">

                    <div class="sectionBlockColumn_sm map-block mcol-xs-12 mcol-sm-6">
                        <div class="map-wrapper">
                            <div id="officeMap" class="officeMap map-container"
                                 data-lat="47.849521"
                                 data-lng="35.115707"
                            ></div>
                        </div>
                    </div>

                    <div class="sectionBlockColumn_sm mcol-xs-12 mcol-sm-6">
                        <div class="sectionBlock">
                           {!! $page['description_'.$locale] !!}
                        </div>
                        @include('site.includes.calculate_button')
                    </div>

                </div>
            </div>
        </section>

    </div>
@endsection