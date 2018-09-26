@extends('site.layouts.app')

@include('site.includes.meta_tags')

@section('content')

    <div id="faqPage" class="faqPage page">

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
                                <h1 class="title">{{ trans('main.faqs') }}</h1>
                            </div>
                        </div>
                        {{ Breadcrumbs::render('faqs') }}
                    </div>
                </div>

                <div class="sectionBlock">
                    <div class="faqCategoryNavBar categoryNavBar">
                        <div class="mobileButtonsWrapper showButton "
                             data-button-type="button" data-menu-type="drop-down" data-target="categoriesMenu">
                            <div class="arrow-button-container">
                                <i class="icomoon icon-angle"></i>
                            </div>
                            <div class="active-category-container">
                                <span class=""></span>
                            </div>
                        </div>

                        <div id="categoriesMenu" class="hiddenContent height filterMenu">
                            <div class="content-container">
                                <button id="all" class="category active">Все</button>
                                @forelse($categories as $category)
                                    <button id="category{{ $category->id }}" class="category">{{ $category['title_'.$locale] }}</button>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sectionBlock">
                    <ul class="faq-list animation">
                        @forelse($all_faqs as $faq)
                            <li data-category="category{{ $faq->faq_category_id }}">
                                <div class="header-block showButton"
                                     data-group="faq-group" data-button-type="accordion" data-menu-type="drop-down">
                                    <div class="content-container">
                                        <h3 class="title">{{ $faq['title_'.$locale] }}</h3>
                                    </div>

                                    <div class="arrow-button-container push-right">
                                        <i class="icomoon icon-angle"></i>
                                    </div>
                                </div>

                                <div class="hiddenContent height faq-group">
                                    <div class="content-container">
                                        <div class="description">
                                            <p>{{ $faq['description_'.$locale] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        @empty
                            Нет вопросов
                        @endforelse

                    </ul>
                </div>

                @include('site.faqs.faq_callback_form')

            </div>
        </section>
    </div>
@endsection