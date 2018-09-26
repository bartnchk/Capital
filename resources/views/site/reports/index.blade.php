@extends('site.layouts.app')

@include('site.includes.meta_tags')

@section('content')
    <div id="aboutRequisitesListPage" class="aboutRequisitesListPage page">

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
                                <h1 class="title">{{ trans('main.financial_reports') }}</h1>
                            </div>
                        </div>

                        {{ Breadcrumbs::render('reports') }}
                        {{--@include('site.includes.breadcrumbs')--}}
                    </div>
                </div>

                <div class="sectionBlock contentBlock">
                    <div class="description">
                        @if(count($reports))
                            <ul>
                                @foreach($reports as $report)
                                    <li>
                                        <a href="{{ route('reports.show', ['report' => $report->alias]) }}" class="link-with-icon">
                                            <i class="icomoon icon-docs"></i>
                                            <span><b>{{ $report['title_'.$locale] }}</b></span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            Пока нет ни одного отчета.
                        @endif
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection




