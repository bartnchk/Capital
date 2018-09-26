<footer class="mainFooter">
    <div class="mcontainer relative">
        <div class="flex wrap spaceBetween">
            <div class="footer-section social-block mcol-xs-12 mcol-sm-4">
                <div class="capital-logo-container">
                    <a href="{{ route('site.home') }}" class="icomoon icon-logo-capital2"></a>
                </div>

                <ul class="social-media-list">
                    <li><a href="{{ $settings->email }}" class="icomoon icon-envelope"></a></li>
                    <li><a href="{{ $settings->viber }}" class="icomoon icon-viber"></a></li>
                    <li><a href="{{ $settings->instagram }}" class="icomoon icon-inst"></a></li>
                    <li><a href="{{ $settings->facebook }}" class="icomoon icon-facebook"></a></li>
                    <li><a href="{{ $settings->youtube }}" class="icomoon icon-youtube"></a></li>
                </ul>
            </div>

            <div class="footer-section feedback-block mcol-xs-12 mcol-sm-7">
                <div class="content-container relative">

                    <div class="quote-icon top"><i class="icomoon icon-quote"></i></div>

                    <h4 class="title article-title">{{ trans('main.feedbacks') }}</h4>

                    <div id="feedbackSlider" class="standardSlider feedbackSlider">
                        @forelse($feedbacks as $feedback)
                            <div class="slide">
                                <div class="description">
                                    <p>{{ $feedback->body }}</p>
                                </div>

                                <div class="info-block">
                                    <div class="author semi-bold">{{ $feedback->name }}, {{ $feedback->city }}</div>
                                    <div class="date">{{ $feedback->date }}</div>
                                </div>
                                <div class="quote-icon bottom"><i class="icomoon icon-quote"></i></div>
                            </div>
                        @empty
                            Нет пока отзывов
                        @endforelse
                    </div>

                    <div class="current-slide">
                        <span class="current">1</span>
                        <span class="all">5</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="developedBy">
            <a href="http://zengineers.company/">
                <span>Разработан в</span>
                <span class="icomoon icon-logo_Z"></span>
            </a>
        </div>
    </div>
</footer>