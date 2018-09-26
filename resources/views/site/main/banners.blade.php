<section class="pageSection banner-section">

    <div id="mainSlider" class="standardSlider mainSlider">
        @foreach($banners as $banner)
            <div class="slide">
                <div class="flex wrap">
                    <div class="image-block imgWrapper mcol-xs-12 mcol-md-6">
                        {{--<img src="img/banner-slide_1.jpg" alt="banner">--}}
                        <img src="{{ asset('storage/images/banners/'.$banner->image) }}" alt="banner">
                    </div>

                    <div class="caption-block mcol-xs-12 mcol-md-6" style="background-image: url('/img/pattern.svg')">
                        <div class="content-container">
                            <h1 class="title caption-title">{{ $banner['title_'.$locale] }}</h1>
                            <div class="description">
                                <p>{{ $banner['description_'.$locale] }}</p>
                            </div>

                            <div class="more-button inversed">
                                <div class="more-button-wrapper">
                                    <div class="more-button-container">
                                        <a href="{{ $banner->link }}" class="title semi-bold">{{ trans('main.details') }}</a>
                                        <i class="icomoon standard-arrow-icon inversed"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="manuals-container">
        <div class="current-slide">
            <span class="current">1</span>
            <span class="all">5</span>
        </div>
    </div>

    <div class="mcontainer">
        <div class="icomoon standard-arrow-icon navigateIcon down"></div>
    </div>
</section>