@extends('site.layouts.app')

@include('site.includes.meta_tags')

@section('content')
    <div id="searchResultsPage" class="searchResultsPage page">

        <section class="pageSection white-bg">
            <div class="mcontainer">
                <div class="sectionBlock">
                    <div class="sectionHeader">
                        <!-- <h1 class="title article-title">Результаты поиска:</h1> -->
                        <div class="contentContainer searchFormContainer">
                            <form  action="{{ route('search') }}" class="searchBlock ">
                                <input type="text" class="title" placeholder="{{ trans('main.search') }} ..." name="q" value="{{ request('q') }}">
                                <div class="borderBlock"></div>
                                <button type="submit" class="js_hide"></button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="sectionBlock">

                    @if(count($results))
                        <ul class="results-list">
                            @foreach($results as $result)
                                <li>
                                    <p class="description-title title"><a href="{{ route($result['type'].'.show', [$result['alias']]) }}" class="underline">{{ $result['title_'.$locale] }}</a></p>
                                    <p>{!! mb_strimwidth(strip_tags($result['description_'.$locale]), 0, 300) !!}</p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        Нет результатов.
                    @endif

                </div>

            </div>
        </section>
        {{ $results->links() }}
    </div>
@endsection