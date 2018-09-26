@extends('site.layouts.app')

@include('site.includes.meta_tags', array('meta_tags' => $client))

@section('content')

    <!-- Start of page code insertion here -->
    <div id="actionPage" class="actionPage page">

        <section class="pageSection white-bg">
            <div class="mcontainer">

                <div class="sectionBlock">
                    <div class="sectionHeader">
                        <h1 class="title article-title">{{ $client['title_'.$locale] }}</h1>

                        {{ Breadcrumbs::render('clients.show', $client->id) }}

                    </div>
                </div>

                <div class="sectionBlock contentBlock">

                    <div class="contentRow">
                        <div class="description mcol-xs-12 mcol-md-7">
                            {!! $client['description_'.$locale] !!}
                        </div>
                    </div>

                    <div class="contentRow images-row mrow flex wrap ">
                        @forelse($client->images as $image)
                            <div class="imgWrapper mcol-xs-6 mcol-sm-4 mcol-md-3">
                                <img src="{{ '/storage/images/client/'.$image->path }}" alt="img">
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>

            </div>
        </section>
    </div>

    <!-- End of page code insertion here -->

@endsection