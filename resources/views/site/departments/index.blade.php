@extends('site.layouts.app')

@include('site.includes.meta_tags')

@section('content')
    <!-- Start of page code insertion here -->
    <div id="departmentsPage" class="departmentsPage page">

        <section class="pageSection white-bg">
            <div class="mcontainer sectionBlock">
                <div class="sectionHeader">
                    <div class="animated-border-block section-title sectionHeaderItem">
                        <div class="svg-container">
                            <svg class="rect-container">
                                <rect x="0" y="0" class="animatedBlock"/>
                                <rect x="0" y="0" stroke-width="4" class="overlappingBlock"/>
                            </svg>
                            <h2 class="title">{{ __('main.offices') }}</h2>
                        </div>
                    </div>

                    {{ Breadcrumbs::render('departments') }}

                </div>

                <div class="sectionBlock">
                  <div class="departmentsCategoryNavBar categoryNavBar tabsNav">
                    <div id="categoriesMenu" class="hiddenContent height tabButtons">
                      <div class="content-container">
                        
                      <button data-target="tabBlock1" class="category tab active">
                        Карта
                      </button>
                      <button data-target="tabBlock2" class="category tab">
                        Список
                      </button>

                      </div>
                    </div>
                  </div>
                </div>

                <div class="sectionBlock filter-block flex wrap center">
                    <div class="formRow chosen-wrapper mcol-xs-12 mcol-sm-6">
                        <label for="2" class="title mcol-xs-12 mcol-sm-4">{{ __('main.city') }}</label>
                        <select name="city" id="city_id" data-placeholder="Все" class="mcol-xs-12 mcol-sm-4">
                            <option value="national">{{ __('main.choose_city') }}</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city['title_'.$locale] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="formRow chosen-wrapper mcol-xs-12 mcol-sm-6">
                        <label for="2" class="title mcol-xs-12 mcol-sm-4">{{ __('main.choose_office') }}</label>
                        <select name="test" id="department" data-placeholder="Текст для ввода" class="mcol-xs-12 mcol-sm-4" data-all="{{ __("main.all_offices") }}">
                            <option value="all">{{ __('main.all_offices') }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mcontainer sectionBlock toggleBlocks-list animation js_animate">
            
              <div id="tabBlock1" class="toggleBlock active">
                <div class="departments-map-block">
                  
                    <div id="departmentsMap" class="departments-map"
                   data-lat="47.856350"
                   data-lng="35.106594"></div>
                  
                </div>
              </div>
              
              <div id="tabBlock2" class="toggleBlock">
                <div class="departments-list-block">

                </div>
              </div>
            
          </div>

        </section>

    </div>
    <!-- End of page code insertion here -->
@endsection

@section('scripts')
    <script src="{{asset('js/site/departmentsMap.min.js')}}"></script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAor2gAXYMTj3AqHp0fBM0EjTKXrlEDavw" async defer></script>
@endsection