<header class="mainHeader">

    <section class="top-section">
        <div class="mcontainer">

            <div class="content-wrapper flex wrap">
                <div class="section-element mcol-xs-hide mcol-md-show mcol-md-auto">
                    <a href="{{ route('faqs') }}" class="faq">{{ trans('main.faqs') }}</a>
                </div>

                <div class="section-element phone phone mcol-md-auto">
                    <i class="icomoon icon-phone mcol-xs-hide mcol-md-show"></i>
                    <span>{{ $settings->phone }}</span>
                    <span class="text dashed">{{ trans('main.call_free') }}</span>
                </div>

                <div class="section-element buttonWrapper fluid mcol-md-auto">
                    {{--<span>{{ trans('main.search') }}</span>--}}
                    <button id="searchButton" type="button" class="searchButton">
                        <i class="icomoon icon-search"></i>
                    </button>
                </div>

                <div class="section-element language">
                    <i class="icomoon icon-language"></i>
                    <ul class="lang-list">
                        <li {{ $locale === 'ru' ? 'class=active' : '' }}>
                            <a href="{{ route('setlocale', ['lang' => 'ru']) }}">RU</a>
                        </li>
                        <li {{ $locale === 'uk' ? 'class=active' : '' }}>
                            <a href="{{ route('setlocale', ['lang' => 'uk']) }}">UA</a>
                        </li>
                    </ul>
                </div>

                <ul class="section-element social-media-list mcol-xs-12 mcol-md-auto backgroundMock">
                    <li><a href="{{ $settings->email }}" class="icomoon icon-envelope"></a></li>
                    <li><a href="{{ $settings->viber }}" class="icomoon icon-viber"></a></li>
                    <li><a href="{{ $settings->instagram }}" class="icomoon icon-inst"></a></li>
                    <li><a href="{{ $settings->facebook }}" class="icomoon icon-facebook"></a></li>
                    <li><a href="{{ $settings->youtube }}" class="icomoon icon-youtube"></a></li>
                </ul>
            </div>

        </div>
    </section>

    <section class="bottom-section">
        <div class="mcontainer backgroundMock">
            <div class="menuMainWrapper">

                <div class="logo-wrapper">
                    <a href="{{ route('site.home') }}" class="icomoon icon-logo-capital"></a>
                </div>

                <div class="menuBlock relative flex center">
                    <a href="#" class="gift-button">
                        <i class="icomoon icon-present"></i>
                        <span class="action">-20%</span>
                    </a>

                    <div class="credit-block">
                        <i class="icomoon icon-calculator"></i>
                        <a href="{{ route('calculator') }}" @if(Route::is('calculator')) class="active" @endif><span>{{ trans('main.calculate') }}</span> <span>{{ trans('main.credit') }}</span></a>
                    </div>

                    <nav id="navMenuWrapper" class="navMenuWrapper hiddenContent scale opacityAnimate">
                        <div id="navMenuContainer" class="navMenuContainer">
                            <div class="menu-logo">
                                <a href="{{ route('home') }}" class="icomoon icon-logo-capital"></a>
                            </div>

                            <ul class="navMenu menu-section accordionMenu">
                                <li><span>{{ trans('main.credits') }}</span>
                                    <i class="icomoon icon-angle accordionButton"></i>
                                    <div class="submenuWrapper">
                                        <ul class="submenu">
                                            <li @if(Route::is('calculator')) class="active" @endif><a href="{{ route('calculator') }}">{{ trans('main.credit_calculator') }}</a></li>
                                            <li @if( basename(request()->path()) == 'get-credit') class="active" @endif><a href="{{ route('pages.show', ['page' => 'get-credit']) }}">{{ trans('main.how_to_get_credit') }}</a></li>
                                            <li @if(Route::is('tariffs')) class="active" @endif><a href="{{ route('tariffs') }}">{{ trans('main.tariff_plans') }}</a></li>
                                            <li @if(Route::is('special.abilities')) class="active" @endif><a href="{{ route('special.abilities') }}">{{ trans('main.special_abilities') }}</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li @if(Route::is('actions')) class="active" @endif><a href="{{ route('actions') }}">{{ trans('main.actions') }}</a></li>
                                <li @if(Route::is('clients')) class="active" @endif><a href="{{ route('clients') }}">{{ trans('main.for_clients') }}</a></li>
                                <li @if(Route::is('departments')) class="active" @endif><a href="{{ route('departments') }}">{{ trans('main.offices') }}</a></li>
                                <li @if( basename(request()->path()) == 'about') class="active" @endif><a href="{{ route('pages.show', ['page' => 'about']) }}">{{ trans('main.about') }}</a>
                                    <i class="icomoon icon-angle accordionButton"></i>
                                    <div class="submenuWrapper">
                                        <ul class="submenu">
                                            <li @if( basename(request()->path()) == 'contacts') class="active" @endif><a href="{{ route('pages.show', ['page' => 'contacts']) }}">{{ trans('main.contacts') }}</a></li>
                                            <li @if(Route::is('news')) class="active" @endif><a href="{{ route('news') }}">{{ trans('main.news') }}</a></li>
                                            <li @if(Route::is('reports')) class="active" @endif><a href="{{ route('reports') }}">{{ trans('main.financial_reports') }}</a></li>
                                            <li @if( basename(request()->path()) == 'rewards') class="active" @endif><a href="{{ route('pages.show', ['page' => 'rewards']) }}">{{ trans('main.company_rewards') }}</a></li>
                                            <li @if( basename(request()->path()) == 'collaboration') class="active" @endif><a href="{{ route('pages.show', ['page' => 'collaboration']) }}">{{ trans('main.collaboration') }}</a></li>
                                            <li @if(Route::is('vacancies')) class="active" @endif><a href="{{ route('vacancies') }}">{{ trans('main.vacancies') }}</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                            <!--  -->
                            <div class="menu-section oneline-chat">
                                <i class="icomoon icon-chat"></i>
                                <a href="#"><span>{{ trans('main.online_chat') }}</span></a>
                            </div>

                            <div class="menu-section credit-block-menu">
                                <i class="icomoon icon-calculator"></i>
                                <a href="#"><span>{{ trans('main.calculate_credit') }}</span></a>
                            </div>

                            <div class="menu-section auth-section">
                                <a href="#" class="standardButton secondary border-decor">
                                    <i class="icomoon icon-login"></i>
                                    <span>{{ trans('main.private_office') }}</span>
                                </a>
                            </div>

                            <div class="menu-section faq-section">
                                <a href="{{ route('faqs') }}">{{ trans('main.faqs') }}</a>
                            </div>

                        </div>
                    </nav>

                    <button id="burgerButton" type="button" class="burgerButton mobileMenuButton">
                        <i class="icomoon icon-burger"></i>
                    </button>

                </div>
            </div>
        </div>
    </section>
</header>