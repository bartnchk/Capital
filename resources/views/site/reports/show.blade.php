@extends('site.layouts.app')

@include('site.includes.meta_tags', array('meta_tags' => $report))

@section('content')
    <div id="aboutRequisitePage" class="aboutRequisitePage page">

        <section class="pageSection white-bg">
            <div class="mcontainer">

                <div class="sectionBlock">
                    <div class="sectionHeader">
                        <h1 class="title article-title">{{ $report['title_'.$locale] }}</h1>

                        {{ Breadcrumbs::render('reports.show', $report->id) }}
                    </div>
                </div>

                <div class="sectionBlock contentBlock">
                    <div class="contentRow">
                        <div class="description">
                            {!! $report['description_'.$locale] !!}
                        </div>
                    </div>

                    @if(count($report->documents))
                        <div class="contentRow">
                            <div class="description">
                                <ul>
                                    @foreach($report->documents as $document)
                                        <li>
                                            <a href="{{ route('reports.download', ['path' => $document->path]) }}" class="link-with-icon" alt="скачать">
                                                <i class="icomoon icon-doc"></i>
                                                <span><b>{{ $document->title or $document->path }}</b></span>
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    @endif

                    @if($report->certificate)
                        <div class="contentRow">
                            <div class="title">{{ trans('main.certificate') }}</div>
                            <div class="imgWrapper document-image">
                                <img src="{{ asset('storage/images/reports/'.$report->certificate) }}" alt="certificate">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection



