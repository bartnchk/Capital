@extends('site.layouts.app')

@include('site.includes.meta_tags', array('meta_tags' => $page))

@section('content')

    <div id="aboutPartnershipPage" class="aboutPartnershipPage page">

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

                <div class="sectionBlock">
                    <div class="description">
                        {!! $page['description_'.$locale] !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection