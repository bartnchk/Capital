@extends('site.layouts.app')


@include('site.includes.meta_tags', array('meta_tags' => $department))

@section('content')
    <!-- Start of page code insertion here -->
    <div id="departmentPage" class="departmentPage page">

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
                                <h1 class="title">{{ __('main.offices') }}</h1>
                            </div>
                        </div>

                        {{ Breadcrumbs::render('departments.show', $department->id) }}

                    </div>
                </div>

                <div class="sectionBlock back-linkBlock">
                    <a href="{{ route('departments') }}" class="back-link">{{ __('main.all_offices') }}</a>
                </div>

                <div class="sectionBlock contentBlock flex wrap">

                    <div class="sectionBlockColumn_sm map-block mcol-xs-12 mcol-sm-6">
                        <div class="map-wrapper">
                            <div id="departmentMap" class="departmentMap map-container"
                                 data-lat="{{ $department->lat }}"
                                 data-lng="{{ $department->lng }}"
                            ></div>
                        </div>
                    </div>

                    <div class="sectionBlockColumn_sm department-description mcol-xs-12 mcol-sm-6">
                        <div class="sectionBlock">
                            <div class="description">
                                <div class="description-title">{{ __('main.office') }} №<span>{{ $department->number }}</span></div>
                            </div>
                        </div>

                        <div class="sectionBlock description">
                            <ul class="contacts-list">
                                <li>
                      <span class="row-with-icon">
                        <i class="icomoon icon-location-pin"></i>
                        <span>@if($locale == 'ru') г.@else м.@endif {{ $department->city['title_'.$locale] }}, {{ $department['address_'.$locale] }}</span>
                      </span>
                                </li>
                                <li>
                      <span class="row-with-icon">
                        <i class="icomoon icon-phone"></i>
                        <a href="tel:{{ $department->phone }}">{{ $department->phone }}</a>
                      </span>
                                </li>
                                <li>
                      <span class="row-with-icon">
                        <i class="icomoon icon-clock"></i>
                        <span>
                            @if($department->time_start)
                                {{ $department->time_start }}-{{ $department->time_end }}
                            @elseif(!$department->time_start and $department['work_days_'.$locale])
                                {{ $department['work_days_'.$locale] }}
                            @else
                                Время не укзано
                            @endif
                        </span>
                      </span>
                                </li>
                            </ul>
                        </div>

                        <div class="sectionBlock department-img-wrapper">
                            @isset($department->image)
                                <img src="{{ '/storage/images/offices/'.$department->image }}" alt="{{ $department->number }}">
                            @endisset
                            @forelse($department->images as $image)
                                <img src="{{ '/storage/images/offices/'.$image->path }}" alt="{{ $department->number }}">
                            @empty
                            @endforelse
                        </div>
                    </div>


                </div>

            </div>
        </section>


    </div>

    <!-- End of page code insertion here -->
@endsection


@section('scripts')
    <script src="{{asset('js/site/departmentsMap.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAor2gAXYMTj3AqHp0fBM0EjTKXrlEDavw" async defer></script>
@endsection